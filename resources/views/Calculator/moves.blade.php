<style>
    .hiddenclass {
        display: none;
    }
</style>
<div class="container-fluid moves">
    <div class="container-fluid moves-heading">
        <div class="container">
            <h1>Moves</h1>
        </div>
    </div>
    <div class="container-fluid subcategory-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 page-bread">
                    <h5 style="font-weight: 300 !important;"><a href="/courses">Home</a></h5> <h5>
                        &nbsp;&nbsp;>&nbsp;&nbsp;Moves</h5>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 filters">

                    <div class="search-filter">
                        <form method="get" action="/courses">
                            <div class="input-group">
                                <label for="search-courses" class="sr-only">{{'courses.search_prompt' | i18n}}</label>
                                <input class='form-control search input-lg' data-list='.list' id='search-courses'
                                       name="query"
                                       placeholder="{{'courses.search_prompt' | i18n}}" type='text'>
                                <span class="input-group-btn">
                          <label for="search-course-button" class="sr-only">Search Courses</label>
                          <button id="search-course-button" class="btn search btn-default btn-lg"
                                  type="submit">{{'courses.search_button'|i18n}}</button>
                        </span>
                            </div>
                        </form>
                    </div>

                    <script>
                        $("#search-courses").on('keyup', function (event) {

                            var lectureArray = $(".search li");
                            //lectureArray.removeClass('hiddenclass');
                            $(".container-fluid .hiddenclass").removeClass('hiddenclass');
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
                            var courser = $(valueJS).parent().parent();
                            if (courser.find('.hiddenclass').length == courser.find('li').length) {
                                courser.addClass('hiddenclass');
                                hideContainer(valueJS);
                            }
                        }

                        function hideContainer(valueJS) {
                            var container = $(valueJS).parents('.container');
                            if (container.find('.search').length == container.find('.search.hiddenclass').length) {
                                container.addClass('hiddenclass');
                            }
                        }

                        $(document).on('click', function (event) {
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
    <div class="container-fluid moves-sub-heading">
        <div class="container">
            <ul>
                <li><h4><a href="#writing">Writing</a></h4></li>
                <li><h4><a href="#research">Research</a></h4></li>
                <li><h4><a href="#drafting">Drafting and Editing</a></h4></li>
                <li><h4><a href="#oralAdvocacy">Oral Advocacy</a></h4></li>
                <li><h4><a href="#immutableRules">Immutable Rules</a></h4></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid moves-block" id="writing">
        <div class="container">
            <h2>Writing</h2>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[0].name }}</h4>
                    {% for lecture in courses[0].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[0].name }}</h4>
                    {% for lecture in courses[0].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[0].name }}</h4>
                    {% for lecture in courses[0].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[0].name }}</h4>
                    {% for lecture in courses[0].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid moves-block" id="research">
        <div class="container">
            <h2>Research</h2>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[1].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[1].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[1].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[1].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid moves-block" id="drafting">
        <div class="container">
            <h2>Drafting and Editing</h2>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 search">
                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[2].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid moves-block" id="oralAdvocacy">
        <div class="container">
            <h2>Oral Advocacy</h2>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 search">
                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[2].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid moves-block" id="immutableRules">
        <div class="container">
            <h2>Immutable Rules</h2>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 search">
                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[2].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 search">


                    <h4>{{ courses[2].name }}</h4>
                    {% for lecture in courses[1].lecture_sections %}
                    <uL>
                        {% for lec in lecture.lectures limit:9 %}
                        <li>
                            <a href="{{lec.url}}">{{lec.name}}</a>
                        </li>
                        {% endfor %}
                    </uL>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>

</div>

