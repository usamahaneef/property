@extends('web.layout.app')
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush
@section('content')
    <livewire:Web.index />
@endsection



@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ks8X2YnLcxTuEC3qydL2adzA0NYbl6c&libraries=geometry,drawing">
    </script>
    <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script>
        let map, drawingManager;

        // Property data
        const properties = [{
            coords: {
                lat: 25.7617,
                lng: -80.1918
            }, // Miami
            title: "Luxury Apartment",
            price: "$500,000",
            beds: 3,
            baths: 2,
            sqft: "2,000 sqft",
            address: "123 Miami St, Miami, FL",
            realtor: "Coldwell Banker Realty",
            images: [
                "{{ asset('web/img/h1.webp') }}", "{{ asset('web/img/h2.webp') }}",
                "{{ asset('web/img/h1.webp') }}"
            ]
        }, {
            coords: {
                lat: 28.5383,
                lng: -81.3792
            }, // Orlando
            title: "Cozy Condo",
            price: "$400,000",
            beds: 2,
            baths: 1,
            sqft: "1,500 sqft",
            address: "456 Orlando Ave, Orlando, FL",
            realtor: "Coldwell Banker Realty",
            images: [
                "{{ asset('web/img/h1.webp') }}", "{{ asset('web/img/h2.webp') }}",
                "{{ asset('web/img/h1.webp') }}"
            ]
        }, ];

        function initMap() {
            // Initialize the map
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 27.9944,
                    lng: -81.7603
                }, // Florida
                zoom: 6,
                mapTypeId: "roadmap",
                fullscreenControl: false,
                zoomControl: window.innerWidth > 768
            });

            // Add markers and InfoWindows
            addPropertyMarkers();

            // Add drawing tools
            initDrawingTools();

            // Add custom map controls
            addMapOptionsButton();
            addDrawToggleButton();
        }

        function addPropertyMarkers() {
            properties.forEach((property, index) => {
                const marker = new google.maps.Marker({
                    position: property.coords,
                    icon: createCustomMarkerIcon(property.price),
                    map: map,
                    title: 'Click to see details'
                });

                const popupContent = createPopupContent(property, index);

                const infoWindow = new google.maps.InfoWindow({
                    content: popupContent,
                    disableAutoPan: true
                });

                // Customize the InfoWindow styles
                google.maps.event.addListener(infoWindow, "domready", () => {
                    customizeInfoWindow();
                });

                // Close the InfoWindow when clicking outside
                google.maps.event.addListener(map, "click", () => {
                    infoWindow.close();
                });

                // Open custom popup on marker click
                marker.addListener("click", () => {
                    // Custom popup positioning
                    const popupDiv = document.createElement('div');
                    popupDiv.innerHTML = popupContent;

                    // Add custom styles to position at the bottom-center
                    popupDiv.classList.add('custom-popup');
                    popupDiv.style.position = 'absolute';
                    popupDiv.style.bottom = '5%';
                    popupDiv.style.left = '40%';
                    popupDiv.style.transform = 'translateX(-50%)';
                    popupDiv.style.zIndex = '1';
                    popupDiv.style.height = 'auto';

                    const mapDiv = map.getDiv();
                    mapDiv.appendChild(popupDiv);

                    // Close the popup if clicked outside
                    google.maps.event.addListener(map, 'click', () => {
                        popupDiv.remove();
                    });
                });
            });
        }

        function createCustomMarkerIcon(price) {
            return {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                scaledSize: new google.maps.Size(40, 40)
            };
        }

        function createPopupContent(property, index) {
            return `
            <div class="card property-popup">
                <div class="card-img-top position-relative">
                    <div class="z-3 position-absolute top-0 start-0 m-2 badge bg-secondary text-white px-3 py-1">Showcase</div>
                    <div class="z-3 position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart fs-3"></i></div>
                    <div id="carousel-${index}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            ${property.images.map((_, i) => `
                                    <button type="button" data-bs-target="#carousel-${index}" data-bs-slide-to="${i}" class="${i === 0 ? 'active' : ''}" aria-label="Slide ${i + 1}"></button>
                                `).join('')}
                        </div>
                        <div class="carousel-inner">
                            ${property.images.map((img, i) => `
                                    <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                        <img src="${img}" class="d-block w-100" alt="${property.title}">
                                    </div>
                                `).join('')}
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${index}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-${index}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="card-body p-1">
                    <div class="d-flex justify-content-between mb-0">
                        <h5 class="card-title">${property.price}</h5>
                        <a href="#" onclick="event.stopPropagation();"><i class="fas fa-ellipsis-h"></i></a>
                    </div>
                    <p class="card-text small">
                        ${property.beds} bds | ${property.baths} ba | ${property.sqft}<br>${property.address}
                    </p>
                </div>
            </div>
        `;
        }

        function customizeInfoWindow() {
            const closeButton = document.querySelector(".gm-ui-hover-effect");
            if (closeButton) closeButton.style.display = "none";
            const iwOuter = document.querySelector(".gm-style-iw");
            if (iwOuter) {
                iwOuter.style.overflow = "visible";
                iwOuter.style.width = "auto";
                iwOuter.style.maxWidth = "none";
            }
        }

        function initDrawingTools() {
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: null,
                drawingControl: false
            });
            drawingManager.setMap(map);
        }

        function addMapOptionsButton() {
            // Create the button
            if (window.innerWidth > 768) {
                var r = "15%";
            } else {
                var r = "5%";
            }
            const mapOptionsButton = document.createElement("button");
            mapOptionsButton.innerHTML = `Map <i class="fa fa-angle-down"></i>`;
            mapOptionsButton.classList.add("btn", "btn-light", "px-3", "map-options-button");
            mapOptionsButton.style.position = "absolute";
            mapOptionsButton.style.bottom = "5%";
            mapOptionsButton.style.right = r;
            mapOptionsButton.style.zIndex = "1";

            // Create the menu
            const mapOptionsMenu = document.createElement("div");
            mapOptionsMenu.classList.add("map-options-menu", "d-none", "bg-white", "p-2", "rounded");
            mapOptionsMenu.style.position = "absolute";
            mapOptionsMenu.style.bottom = "calc(5% + 50px)"; // Position menu above the button
            mapOptionsMenu.style.right = r;
            mapOptionsMenu.style.zIndex = "1000";
            mapOptionsMenu.style.width = "300px"; // Adjust width as needed
            mapOptionsMenu.innerHTML = `
        <div class="card border-0 w-100">
            <div class="card-body">
                <h5 class="card-title">Map Options</h5>
                <form>
                    <!-- Map Options -->
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="mapType" value="automatic" checked>
                            <span class="form-check-label">Automatic</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="mapType" value="satellite">
                            <span class="form-check-label">Satellite</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="mapType" value="streetview">
                            <span class="form-check-label">Street view</span>
                        </label>
                    </div>
                    <!-- Climate Risks -->
                    <h6 class="mt-4">Climate Risks</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="none" checked>
                                <span class="form-check-label">None selected</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="flood">
                                <span class="form-check-label">Flood</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="fire">
                                <span class="form-check-label">Fire</span>
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="wind">
                                <span class="form-check-label">Wind</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="air">
                                <span class="form-check-label">Air</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="climateRisk" value="heat">
                                <span class="form-check-label">Heat</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>`;

            // Toggle menu visibility on button click
            mapOptionsButton.addEventListener("click", (event) => {
                event.stopPropagation(); // Prevent event from bubbling to the document
                mapOptionsMenu.classList.toggle("d-none");
            });

            // Update map type on menu change
            mapOptionsMenu.addEventListener("change", (event) => {
                if (event.target.name === "mapType") {
                    map.setMapTypeId(event.target.value);
                }
            });

            // Hide the menu when clicking outside
            document.addEventListener("click", (event) => {
                const isClickInsideMenu = mapOptionsMenu.contains(event.target);
                const isClickOnButton = mapOptionsButton.contains(event.target);

                if (!isClickInsideMenu && !isClickOnButton) {
                    mapOptionsMenu.classList.add("d-none");
                }
            });

            // Append button and menu directly to the map container
            const mapContainer = map.getDiv();
            mapContainer.appendChild(mapOptionsButton);
            mapContainer.appendChild(mapOptionsMenu);
        }

        function addDrawToggleButton() {
            // Create the button
            const drawToggleButton = document.createElement("button");
            drawToggleButton.textContent = "Draw";
            drawToggleButton.classList.add("btn", "btn-primary", "draw-toggle-button");

            // Toggle drawing mode on click
            drawToggleButton.addEventListener("click", () => {
                const currentMode = drawingManager.getDrawingMode();
                drawingManager.setDrawingMode(currentMode ? null : "polygon");
            });

            // Create a container for the button
            const controlDiv = document.createElement("div");
            controlDiv.style.position = "absolute";
            controlDiv.style.top = "5%";
            controlDiv.style.right = "5%";
            controlDiv.style.zIndex = "1"; // Ensure the button is above the map
            controlDiv.appendChild(drawToggleButton);

            // Append the controlDiv directly to the map's container
            const mapContainer = map.getDiv();
            mapContainer.appendChild(controlDiv);
        }

        window.onload = initMap;
    </script>


    <script>
        //    dropwdow filters start
        $(document).ready(function() {
            // Main Initialization
            $('.dropdown').each(function() {
                const dropdown = $(this);

                if (dropdown.hasClass('price-dropdown')) {
                    handlePriceDropdown(dropdown);
                } else if (dropdown.hasClass('more-filters-dropdown')) {
                    handleMoreFiltersDropdown(dropdown);
                } else if (dropdown.hasClass('home-type-dropdown')) {
                    handleHomeTypeDropdown(dropdown);
                } else if (dropdown.hasClass('bedrooms-bathrooms-dropdown')) {
                    handleBedroomsBathroomsDropdown(dropdown);
                } else {
                    handleGenericDropdown(dropdown);
                }
            });
        });

        // Generic Dropdown Handler
        function handleGenericDropdown(dropdown) {
            const applyButton = dropdown.find('.apply-filter');
            const dropdownMenu = dropdown.find('.dropdown-menu');
            const selectedFilter = dropdown.find('.selected-filter');

            dropdownMenu.on('click', function(e) {
                e.stopPropagation();
            });

            applyButton.on('click', function() {
                let displayValue = '';
                const selectedRadio = dropdownMenu.find('input[type="radio"]:checked');
                if (selectedRadio.length > 0) {
                    displayValue = selectedRadio.next('label').text();
                }
                selectedFilter.text(displayValue.trim() || 'No filter selected');
                closeDropdown(dropdown);
            });
        }

        // Bedrooms & Bathrooms Dropdown Handler
        function handleBedroomsBathroomsDropdown(dropdown) {
            const applyButton = dropdown.find('.apply-filter');
            const dropdownMenu = dropdown.find('.dropdown-menu');
            const selectedFilter = dropdown.find('.selected-filter');

            dropdownMenu.on('click', function(e) {
                e.stopPropagation();
            });

            applyButton.on('click', function() {
                let bedroomsLabel = '';
                let bathroomsLabel = '';

                // Get selected bedrooms
                const selectedBedroom = dropdownMenu.find('input[name="btnradio"]:checked').next('label').text();
                if (selectedBedroom && selectedBedroom !== 'Any') {
                    bedroomsLabel = `${selectedBedroom} bd`;
                }

                // Get selected bathrooms
                const selectedBathroom = dropdownMenu.find('input[name="bathroom"]:checked').next('label').text();
                if (selectedBathroom && selectedBathroom !== 'Any') {
                    bathroomsLabel = `${selectedBathroom} ba`;
                }

                // Combine and update the display label
                const displayValue = [bedroomsLabel, bathroomsLabel].filter(Boolean).join(', ') ||
                    'No filter selected';
                selectedFilter.text(displayValue.trim());
                closeDropdown(dropdown);
            });
        }

        // Price Dropdown Handler
        function handlePriceDropdown(dropdown) {
            const applyButton = dropdown.find('.apply-filter');
            const dropdownMenu = dropdown.find('.dropdown-menu');
            const selectedFilter = dropdown.find('.selected-filter');

            applyButton.on('click', function() {
                const rangeSelectors = dropdownMenu.find('select');
                let minValue = rangeSelectors.eq(0).val();
                let maxValue = rangeSelectors.eq(1).val();
                let displayValue = '';

                if (minValue && maxValue && parseInt(maxValue) < parseInt(minValue)) {
                    alert('Maximum value must be greater than or equal to Minimum value.');
                    return;
                }

                displayValue = `$${minValue || '0'} - $${maxValue || 'No Limit'}`;
                selectedFilter.text(displayValue.trim());
                closeDropdown(dropdown);
            });
        }

        // Home Type Dropdown Handler
        function handleHomeTypeDropdown(dropdown) {
            const applyButton = dropdown.find('.apply-filter');
            const dropdownMenu = dropdown.find('.dropdown-menu');
            const selectedFilter = dropdown.find('.selected-filter');

            applyButton.on('click', function() {
                const selectedCheckboxes = dropdownMenu.find('input[type="checkbox"]:checked');
                const totalFilters = selectedCheckboxes.length;
                const displayValue = totalFilters > 0 ? `Home Type (${totalFilters})` : 'Home Type';
                selectedFilter.text(displayValue);
                closeDropdown(dropdown);
            });
        }

        // More Filters Dropdown Handler
        function handleMoreFiltersDropdown(dropdown) {
            const applyButton = dropdown.find('.apply-filter');
            const dropdownMenu = dropdown.find('.dropdown-menu');
            const selectedFilter = dropdown.find('.selected-filter');

            applyButton.on('click', function() {
                const totalFilters = dropdownMenu.find('input[type="checkbox"]:checked, select').length;
                const displayValue = totalFilters > 0 ? `More (${totalFilters})` : 'More';
                selectedFilter.text(displayValue);
                closeDropdown(dropdown);
            });
        }

        // Utility to Close Dropdown
        function closeDropdown(dropdown) {
            const bsDropdown = bootstrap.Dropdown.getInstance(dropdown.find('[data-bs-toggle="dropdown"]')[0]);
            if (bsDropdown) {
                bsDropdown.hide();
            }
        }

        //    dropwdow filters end

        let myCarousel = document.querySelectorAll('.featureContainer .carousel .carousel-item');
        myCarousel.forEach((el) => {
            const minPerSlide = 4
            let next = el.nextElementSibling
            for (var i = 1; i < minPerSlide; i++) {
                if (!next) {
                    // wrap carousel by using first child
                    next = myCarousel[0]
                }
                let cloneChild = next.cloneNode(true)
                el.appendChild(cloneChild.children[0])
                next = next.nextElementSibling
            }
        });

        $(document).on('click', '.card', function(event) {
            // Exclude certain elements from triggering the popup
            if (!$(event.target).is(
                    'a, button, i, .indicator, .carousel-control-prev-icon, .carousel-control-next-icon')) {
                var modalId = $(this).data('modal-id');

                // Show the modal using the fetched modal ID
                $('#' + modalId).modal('show');
            }
        });



        $("#toggle_map_button,#toggle_property_listing_button").click(function(e) {
            e.preventDefault(); // Prevent default action
            $(".google_map").toggle(); // Toggle visibility of the map
            $(".scrollable").toggle(); // Toggle visibility of the listing
            $("#toggle_map_button,#toggle_property_listing_button,#toggle_sort_button").toggleClass('d-none');
        });
    </script>
@endpush
