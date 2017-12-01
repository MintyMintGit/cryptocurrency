{% if filter_type contains 'category' and name %}
<div class="view-school">
    <div class="blocks-page blocks-page-rich_text" id="blocks-page-1248599">
        <div class="course-block block liquid_html " id="block-4705076">
            <div class="container-fluid subcategory-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 page-bread">
                            <h5 style="font-weight: 300 !important;"><a href="/courses">All</a></h5>
                            <h5>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="{{ category.name }}"
                                                               data-role="course-box-link">{{ category.name }}</a></h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 filters">
                            <div class="category-filter" id="heading-category-select">
                                <div class="category-select">
                                    {{ category.name }} ({{category.course_count}})
                                    <i class="fa fa-caret-down" aria-hidden="true">

                                    </i>
                                </div>
                                <div class="dropdown" style="display: none;">
                                    <ul>
                                        {% for categoryItem in current_school.categories %}
                                        {% if categoryItem.is_published and categoryItem.course_count > 0 %}
                                        {% if category.name != categoryItem.name%}
                                        <li>
                                            <a href="{{ school.url }}/courses/category/{{ categoryItem.name }}">{{ categoryItem.name | replace: '-', ' ' }}
                                                ({{categoryItem.course_count}})</a>
                                        </li>
                                        {% endif %}
                                        {% endif %}
                                        {% endfor %}
                                    </ul>
                                </div>
                            </div>
                            <div class="search-filter">
                                <form method="get" action="/courses">
                                    <div class="input-group">
                                        <label for="search-courses" class="sr-only">Find a course</label>
                                        <input class="form-control search input-lg" data-list=".list"
                                               id="search-courses" name="query" placeholder="Find a course" type="text">
                                        <span class="input-group-btn">
                          <label for="search-course-button" class="sr-only">Search Courses</label>
                          <button id="search-course-button" class="btn search btn-default btn-lg" type="submit"><i
                                      class="fa fa-search"></i></button>
                        </span>
                                    </div>
                                </form>
                            </div>

                            <script>
                                $("#search-courses").on('keyup', function (event) {
                                    var lectureArray = $(".lecture li");
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
                                    if (courser.find('.hiddenclass').length == courser.find('li').length) {
                                        $(courser.parents('.container-fluid.line')).addClass('hiddenclass');
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
                            <div class="col-md-9 col-sm-9 col-xs-12 lecture">
                                <ul>
                                    {% for lecture in course.lecture_sections %}
                                    {% for lec in lecture.lectures limit:9 %}
                                    <li><a href="{{lec.url}}">{{lec.name}}</a></li></p>
                                    {% endfor %}
                                    {% endfor %}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {% endfor %}
            </div>

            <a href="/courses/237329/lectures/3839487">

            </a></div>
        <a href="/courses/237329/lectures/3839487">


        </a></div>
    <a href="/courses/237329/lectures/3839487">


    </a>
    <footer class="container-fluid"><a href="/courses/237329/lectures/3839487">
        </a>
        <div class="container"><a href="/courses/237329/lectures/3839487">
                <div class="col-md-4 col-sm-4 col-xs-12 logo">
                    <img src="https://process.fs.teachablecdn.com/ADNupMnWyR7kCWRvm76Laz/resize=height:60/https://www.filepicker.io/api/file/v3qkQPKUROurko1n6oct"
                         alt="">
                    <p>@write.law 2017</p>
                </div>
            </a>
            <div class="col-md-4 col-sm-4 col-xs-12 footer-nav"><a href="/courses/237329/lectures/3839487">

                </a>
                <div class="list-unstyled"><a href="/courses/237329/lectures/3839487">

                    </a>
                    <li><a href="/courses/237329/lectures/3839487">
                        </a><a href="#" target="">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="/p/faq" target="">
                            FAQ
                        </a>
                    </li>

                    <li>
                        <a href="/p/about-us" target="">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="/p/contact" target="">
                            Contact Us
                        </a>
                    </li>


                </div>

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 footer-socials">
                <div class="item">
                    <a href="#"><img src="https://www.filepicker.io/api/file/23Xura7QmKDDkhrPZQNw" alt=""></a>
                    <a href="#"><img src="https://www.filepicker.io/api/file/KT4L5Ub3TlmsbQs0EJCG" alt=""></a>
                </div>
                <a href="/p/terms">
                    Terms of Use
                </a><br>

                <a href="/p/privacy">
                    Privacy Policy
                </a>
            </div>
        </div>
    </footer>


</div>

{% else %}


<div class="container-fluid home-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-sx-12">
                <h1>
                    You, too, can write like the nation's best attorneys.
                </h1>
                <a class="btn btn-primary" href="#writing">View all courses</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-hero-sub">
    <div class="container">
        <div class="rows">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <h4><a href="#writing">Writing</a></h4>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <h4><a href="#technology">Technology</a></h4>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <h4><a href="#productivity">Productivity</a></h4>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <h4><a href="#oral_advocacy">Oral Advocacy</a></h4>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <h4><a href="#cognitive_science">Cognitive Science</a></h4>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <h4><a href="#checklists">Checklists</a></h4>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-writing" id="writing">
    <h2>Writing</h2>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-writing" id="technology">
    <h2>Technology</h2>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-writing" id="productivity">
    <h2>Productivity</h2>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-writing" id="oral_advocacy">
    <h2>Oral Advocacy</h2>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-writing" id="cognitive_science">
    <h2>Cognitive Science</h2>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home-writing" id="checklists">
    <h2>Checklists</h2>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid line">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="item">
                        <a href="#"><img src="https://www.filepicker.io/api/file/qpR56gglRyeoD14CJt17" alt=""></a>
                        <h4><a href="#">Immutable Rules</a></h4>
                        <span>About this courses</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Passive Voice</a></p>
                    <p><a href="">Thesis Sentences</a></p>
                    <p><a href="">Parallel sentence structure</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Sentence fragments</a></p>
                    <p><a href="">Focus your sentences on people</a></p>
                    <p><a href="">Transitions</a></p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <p><a href="">Using Quotes</a></p>
                    <p><a href="">Writing Clear sentences</a></p>
                    <p><a href="">Writing Concise Sentences</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

{% endif %}

{% alert_messages %}

<p>123</p>
{% capture number_of_courses_to_display %} {{courses|size }} {%endcapture%}

<h1><u>NULL</u></h1>
{% for category in current_school.categories %}
{% assign catname = category.name %}
<p id="catNames">{{catname}}</p>
{% endfor %}

{% for category in courses %}
<p>link = {{category.course_link_for_user}}</p>
{% endfor %}

<br>
<a href="{{course_box.course_link_for_user}}" data-role="course-box-link">link</a>

<h1><u>END NULL</u></h1>

<p>categories = {{current_school.name}}</p>

{% assign index = 0 %}
{% for category in current_school.categories %}
<p>category.name= {{category.name}}</p>
<p>category.id= {{category.id}}</p>
{% if category.name == 'CategoryOne' %}

<p>Category size {{category.course_count}}</p>

{% for item in category.course_count %}
<p>courses[index].name = {{courses[index].name}} </p>
{% increment index %}
{% endfor %}

<p>index={{index}}</p>

{% endif %}

{% if category.name == 'randomCategory' %}

<p>Category size {{category.course_count}}</p>

{% for item in category.course_count %}
<p>courses[index].name = {{courses[index].name}} </p>
{% increment index %}
{% endfor %}

<p>index={{index}}</p>

{% endif %}
{% endfor %}
<p>end work</p>

<p></p>
<p>second</p>
{% for course in courses %}
<p>course.name = {{course.name}}</p>
{% if course.name == 'Write.law' %}
<p>courses = {{courses|size}}</p>
{% endif %}

{% if course.name == 'Take Control of Your Sentences' %}
<p>courses = {{courses|size}}</p>
{% endif %}

{% if course.name == 'Mindful course name' %}
<p>courses = {{courses|size}}</p>
{% endif %}
{% endfor %}
<p>end second</p>
<p></p>


{% for course in courses %}
{% assign var = course.id </p> %}
<p>var={{var}}</p>
<p>courses = {{courses|size}}</p>
{% endfor %}
<p>---------</p>
<p>json format = {{courses}}</p>
<p>---------</p>
{% for course in courses %}
<p>link = {{course.course_link_for_user}}</p>
<p>NEW THING = {{course.name }}<p>
<p>id={{course.id}}</p>
<p>id={{course.id}}</p>
{% endfor %}
<p>---------</p>


<h1>First</h1>
<p>courses.name={{courses.name}}</p>
{% for course in courses %}
<p>course.name={{course.name}}</p>
<p>course.id={{course.id}}</p>
{% if course.name == 'CategoryOne' %}
<p>courses = {{courses|size}}</p>
{% endif %}
{% endfor %}
<h1>Second</h1>
{% for category in current_school.categories %}
<p>category.name = {{category|size}}</p>
<p>category.id = {{category.id}}</p>
{% endfor %}
<p>------------</p>

<br>
<a href="{{course_box.course_link_for_user}}" data-role="course-box-link">link course_box.name</a>

<div class='view-directory course-directory {% if current_user %}signed-in-directory{% endif %}'>
    <div class='container'>
        <div class='row search'>
            {% if lecture_progresses.size %}{% else %}
            <!-- Filter: Category -->
            <div class='pull-left course-filter'>
                <div class="filter-label">
                    {{'courses.category_filter'|i18n}}
                </div>
                <div class="btn-group">
                    <button class="btn btn-default btn-lg btn-course-filter dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-expanded="false">
                        {% if filter_type contains 'category' and name %}
                        {{ name | replace: '-', ' ' }} <span class="caret"></span>
                        {% else %}
                        {{'courses.all_filter'|i18n}} <span class="caret"></span>
                        {% endif %}
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ school.url }}/courses">{{'courses.all_filter'|i18n}}</a></li>
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
            <!-- Filter: Author -->
            <div class='pull-left course-filter'>
                <div class="filter-label">
                    {{'courses.author_filter'|i18n}}
                </div>
                <div class="btn-group">
                    <button class="btn btn-default btn-lg btn-course-filter dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-expanded="false">
                        {% if filter_type contains 'author' and name %}
                        {{ name }} <span class="caret"></span>
                        {% else %}
                        {{'courses.all_filter'|i18n}} <span class="caret"></span>
                        {% endif %}
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ school.url }}/courses">{{'courses.all_filter'|i18n}}</a></li>
                        {% for author in current_school.author_bios %}
                        <li><a href="{{ school.url }}/courses/author/{{ author.id }}">{{ author.name }}</a></li>
                        {% endfor %}
                    </ul>
                </div>
            </div>
            {% endif %}

            <!-- Search Box -->
            <div class='{% if lecture_progresses.size %}col-lg-12 col-md-12{% else %}col-lg-4 col-md-4{% endif %} col-xs-12 pull-right'>
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
            </div>
        </div>
        <!-- Filter Title & Description-->
        {% if name %}
        <div class='row filter-title'>
            <div class='col-lg-12 col-md-12'>
                {% if author_image %}
                <img class='large-img-rounded img-responsive' src='{{ author_image }}' role='presentation'>
                {% endif %}
                <div class="col-sm-9">
                    <h2>{{ name }}</h2>
                    <p>{{ description }}</p>
                </div>
                <br>
            </div>
        </div>
        {% endif %}
        <div class='row course-list list'>
            {% include "courses/partials/course_box" for courses limit:number_of_courses_to_display %}
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <center>
                    {% course_pagination %}
                </center>
            </div>
        </div>
        <br>
    </div>
</div>