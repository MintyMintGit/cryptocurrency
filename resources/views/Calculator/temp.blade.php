<div class="container-fluid subcategory-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 page-bread">
                <h5 style="font-weight: 300 !important;"><a href="/courses">All</a></h5> <h5>
                    &nbsp;&nbsp;>&nbsp;&nbsp;{{ current_school.name }}</h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 filters">
                <div class="category-filter" id="heading-category-select">
                    <div class="category-select">
                        <i class="fa fa-caret-down" aria-hidden="true">
                            {% if current_school.name %}
                            {{ current_school.name }}
                            {% endif %}
                        </i>
                    </div>
                    <div class="dropdown">
                        <ul>
                            {% for category in current_school.categories %}
                            {% if category.is_published and category.course_count > 0 %}
                            <li>
                                <a href="{{ school.url }}/courses/category/{{ category.name }}">{{ category.name | replace: '-', ' ' }}
                                    ({{category.course_count}})</a></li>
                            {% endif %}
                            {% endfor %}
                        </ul>
                    </div>
                </div>
                <div class="search-filter">
                    <input type="search" id="search" placeholder="Search courses">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
                <form method="get" action="/courses">
                    <div class="input-group">
                        <label for="search-courses" class="sr-only">{{'courses.search_prompt' | i18n}}</label>
                        <input class='form-control search input-lg' data-list='.list' id='search-courses' name="query"
                               placeholder="{{'courses.search_prompt' | i18n}}" type='text'>
                        <span class="input-group-btn">
                          <label for="search-course-button" class="sr-only">Search Courses</label>
                          <button id="search-course-button" class="btn search btn-default btn-lg"
                                  type="submit">{{'courses.search_button'|i18n}}</button>
                        </span>
                    </div>
                </form>
                <script>
                    $("#search-courses").on('keyup', function (event) {
                        var lectureArray = $(".lecture p");
                        lectureArray.removeClass('hiddenclass');
                        $('.container-fluid.line').removeClass('hiddenclass');
                        var elSearch = $(event.currentTarget).val();
                        findElementsHide(elSearch, lectureArray);
                    });

                    function findElementsHide(elSearch, lectureArray) {
                        var elSearch = elSearch.toLowerCase();
                        $.each(lectureArray, function (index, value) {
                            if (-1 == value.innerText.toLowerCase().indexOf(elSearch)) {
                                $(value).addClass('hiddenclass');
                                hideCourse(value);
                            }
                        });
                    }

                    function hideCourse(valueJS) {
                        var courser = $(valueJS).parent();
                        if ( courser.find('.hiddenclass').length == courser.find('p').length ) {
                            $(courser.parents('.container-fluid.line')).addClass('hiddenclass');
                        }
                    }

                    $(document).on('click', function(event) {
                        if (!$(event.target).closest('#heading-category-select').length) {
                            $('#heading-category-select .dropdown').hide();
                            $('#heading-category-select .category-select').removeClass('open');
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<style>
    .exclusive {
        width: 52px;
        height: 49px;
    }
    .hiddenclass {
        display: none;
    }
</style>
<div class="container-fluid home-writing sub-category">
    <div class="container"><h2>Style Moves</h2></div>
    {% for course in courses %}
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <img class="exclusive" src="{{ course.safe_image_url }}" alt="">
                        <h4><a href="{{ course.url }}">{{ course.name }}</a></h4>
                        <span>{{ course.heading }}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 lecture">
                    {% for lecture in course.lecture_sections %}
                    {% for lec in lecture.lectures limit:9 %}
                    <p><a href="{{lec.url}}">{{lec.name}}</a></p>
                    {% endfor %}
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
    {% endfor %}
</div>