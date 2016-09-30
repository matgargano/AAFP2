var searchData = {

    countries: JSON.parse('{"countries":["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua","Argentina","Armenia","Aruba","Ascension","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman","Central African Republic","Chad","Chile","China","Colombia","Comoros","Congo","Cook Islands","Costa Rica","CÃ´te d`Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Diego Garcia","Djibouti ","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","England","Equatorial Guinea ","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands ","Fiji","Finland","France","French Antilles","French Guiana","French Polynesia","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Great Britain","Greece","Greenland","Grenada","Guam","Guatemala ","Guinea","Guinea-Bissau ","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakstan","Kenya","Kiribati ","Korea","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein ","Lithuania","Luxembourg ","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique ","Mauritania ","Mauritius ","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montserrat ","Morocco","Mozambique ","Myanmar ","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua ","Niger","Nigeria","Niue","North Korea","Northern Mariana Islands ","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Helena","Saint Kitts and Nevis ","Saint Lucia","Saint Pierre and Miquelon ","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Scotland","Senegal","Serbia","Seychelles ","Sierra Leone","Singapore","SLOVAKIA","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","Spain","Sri Lanka","Sudan","Suriname","Swaziland ","Sweden","Switzerland","Syria","Taiwan","Tajikistan ","Tanzania","Thailand","Togo","Tokelau ","Tonga","Trinadad and Tobago","Tunisia","Turkey","Turkmenistan ","Turks and Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Virgin Islands","Uruguay","Uzbekistan ","Vanuatu ","Venezuela","Vietnam","Wallis and Futuna ","West Indies","Yemen","Yugoslavia","Zaire","Zambia","Zimbabwe"]}'),
    proxy: false,
    catFriendly: 0,
    zoomLevel: 14,
    proxyUrl: 'https://jsonp.afeld.me/?callback=%callback%&url=%url%',
    statesApiUrl: 'http://www.catvets.com/svc/practiceSearch/getSelectValues?selectedCountry=%country%',
    practiceUrl: {
        location: 'http://www.catvets.com/svc/practiceSearch/searchByLocation?zipCode=%zip%&distance=%distance%&country=%country%&state=%state%&city=%city%&practiceType=%practicetype%',
        name: 'http://www.catvets.com/svc/practiceSearch/searchByName?fName=%fName%&lName=%lName%&practiceName=%practiceName%&country=%country%&state=%state%&city=%city%&practiceType=%practicetype%'
    },
    officeTemplate: _.template('<div data-lat="<%- lat %>" data-lng="<%- lng %>" class="search-result-single <%- catfriendly %>">Doctor: <%= doctor %><br>Name: <%= name %><br>Address: <%= address %><br>Distance: <%= distance %></div>')
};

var map;


jQuery(document).ready(function ($) {

    var $body = $('body'),
        getUrl = function (url) {
            if (searchData.proxy) {
                return searchData.proxyUrl.replace('%callback%', '?').replace('%url%', url);
            }
            return url;
        },
        $countrySelect = jQuery('.country'),
        newOptionElement = function (element, text, selected) {
            if (!text) {
                text = element;
            }
            var selectedAttribute = '';
            if (selected) {
                selectedAttribute = 'selected="selected"';
            }


            return '<option value="' + element + '" ' + selectedAttribute + '>' + text + '</option>';
        };

    //toggle more/less on forms
    $('.more-options').on('click', function () {
        var $outerWrapper = $(this).parents('.search-form'),
            $text = $(this).find('span');

        $text.toggle();

        $outerWrapper.find('.more-options-wrap').toggle();
    });


    // populate search countries
    var elements;
    searchData.countries.countries.forEach(function (country) {
        elements += newOptionElement(country, false);
    });


    $countrySelect.each(function () {
        $(this).append(elements);
    });

    // trigger states

    $countrySelect.on('change', function (e) {
        var $outerWrapper = $(this).parents('.country-wrapper'),
            $states = $outerWrapper.find('.states'),
            selectedCountry = $(this).find(':selected').text(),
            url = getUrl(searchData.statesApiUrl.replace('%country%', selectedCountry));
        $.getJSON(url, function (data) {
            $states.html('');

            if (data.data.selectValues.states.length > 0) {
                var elements = '<label for="state">State</label><select name="state" class="form-control"><option value=""> --- Select --- </option>';
                data.data.selectValues.states.forEach(function (element) {
                    elements += newOptionElement(element.adr_state, element.state_name);
                });
                elements += '</select>';
                $states.append(elements);
            }
        });
    });


    // handle the form search
    $('form.search-form').on('submit', function (e) {
        e.preventDefault();
        $('.no-results').hide();
        var $form = $(this);
        $(this).css('opacity', '.5');

        var type = $(this).data('type'),
            searchObject = buildSearchObject($(this)),

            // build URL
            url = buildApiUrl(type, searchObject);
        buildResults(url, function () {
            $form.css('opacity', '1');
        });

    });

    function buildApiUrl(type, searchObject) {


        var url = searchData.practiceUrl[type];

        for (var target in searchObject) {


            url = url.replace('%' + searchObject[target].name + '%', searchObject[target].val);

        }

        url = stripRemainingTokens(url);

        return url;

    }


    // lets build the URL
    function buildSearchObject($form) {
        var serializedForm = [];
        $form.find('input, select, textarea').each(function () {


            if (!$(this).is(':visible')) {
                return;
            }


            if ($(this).attr('name')) {


                serializedForm.push({
                    name: $(this).attr('name'),
                    val: $(this).is('option') ? $(this).find(':selected').val() : $(this).val()
                });


            }

        });
        return serializedForm;
    }

    // lets get all tokens

    function stripRemainingTokens(url) {
        var regex = /\%([^\%]+)\%/g;
        var matches = url.match(regex);
        if (matches.length > 0) {
            matches.forEach(function (token) {
                url = url.replace(token, '');
            });
        }


        return url;
    }

    function buildMap(practitioner) {

        map = new google.maps.Map(document.getElementById('map-container'), {
            center: new google.maps.LatLng(practitioner.lat, practitioner.lng),
            zoom: searchData.zoomLevel
        });
    }

    function buildResults(url, cb) {
        $.getJSON(url, function (data) {
            $('.map-container').show();
            $('.results .inner').html('');
            var output = '',
                counter = 0;
            $("html, body").animate({scrollTop: $('#scroll-map-container').offset().top - 50}, 500);
            if (

                ( data.data.hasOwnProperty('practitionerList') && (!Array.isArray(data.data.practitionerList) || data.data.practitionerList.length == 0  ) ) ||
                (!data.data.hasOwnProperty('practitionerList'))


            ) {
                $('.results').show(function () {
                    $('.no-results').show();
                    $('.map-container').hide();
                });
                cb();
                return;
            }

            data.data.practitionerList.forEach(function (practitioner) {
                if (counter === 0) {
                    buildMap(practitioner);
                }

                counter++;

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(practitioner.lat, practitioner.lng),
                    map: map
                });

                var address = practitioner.adr_line1;


                if (practitioner.adr_line2) {
                    address += '<br>' + practitioner.adr_line2;
                }
                if (practitioner.adr_line3) {
                    address += '<br>' + practitioner.adr_line3;
                }
                address += '<br>' + practitioner.adr_city + ' ' + practitioner.adr_state + ' ' + practitioner.adr_post_code;

                output += searchData.officeTemplate({
                    lat: practitioner.lat,
                    lng: practitioner.lng,
                    catfriendly: practitioner.cat_friendly_prac_gold === "1" || practitioner.cat_friendly_prac_silver === "1" ? 'cat-friendly-result' : '',
                    doctor: practitioner.ind_prf_code + ' ' + practitioner.ind_first_name + ' ' + practitioner.ind_last_name,
                    name: practitioner.cst_org_name_dn,
                    address: address,
                    distance: practitioner.distance,

                });
                $('.results').show(function () {
                    $('.results .inner').html(output);
                });

            });


        }).done(function () {
            cb();

        });
    }

    $body.on('click', '.search-result-single', function () {

        $("html, body").animate({scrollTop: $('#scroll-map-container').offset().top - 50}, 500);

        var lat = $(this).attr('data-lat');
        var lng = $(this).attr('data-lng');
        var center = {lat: parseFloat(lat), lng: parseFloat(lng)};
        map.setCenter(center);
        map.setZoom(searchData.zoomLevel);

    });

    $('.cat-friendly-checkbox').on('change', function () {
        var ischecked = $(this).is(':checked');
        if (!ischecked) {
            $('.search-result-single').show();
        } else {
            $('.search-result-single').hide();
            $('.cat-friendly-result').show();
        }

    });


});

