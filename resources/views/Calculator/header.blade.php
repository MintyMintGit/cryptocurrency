{% if filter_type contains 'category' and name %}
<!-- HEADER -->
<header class=''>
    <!-- Navbar -->
    <div class="navbar navbar-fedora navbar-fixed-top is-at-top bs-docs-nav show-nav-background-color {{ site.context_css_classes }}" id='navbar' role='navigation'>
        <div class='container'>
            <div class='navbar-header'>
                <button class='navbar-toggle' data-target='.navbar-header-collapse' data-toggle='collapse' type='button'>
          <span class='sr-only'>
            {{ 'common.toggle_nav' | i18n }}
          </span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <!-- Site logo -->
                {% if site.logo_url != null %}
                <a class='navbar-brand header-logo' href='{{current_school.url | school_link}}'>
                    <span class="sr-only">{{current_school.name}}</span>
                    <img src="{{ site.logo_url }}" alt="{{ current_school.name }}" srcset="{{ site.logo_url_2x }} 2x" />
                </a>
                {% else %}
                <a class='school-title navbar-brand' href='{{current_school.url | school_link}}'>
                    {{ current_school.name}}
                </a>
                {% endif %}

                <!-- Header Menu -->
                <div class='collapse navbar-collapse navbar-header-collapse'>
                    {% include "layouts/partials/header_links" %}
                </div>
            </div>
        </div>
        <div class="container-fluid custom-dropdown">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Writing </h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Technology</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Productivity</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>

                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Oral Advocacy</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Cognitive Science</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Checklists</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{% elsif page.url contains 'sign_up' %}
<!-- HEADER -->
<header class=''>
    <!-- Navbar -->
    <div class="navbar navbar-fedora navbar-fixed-top is-at-top bs-docs-nav show-nav-background-color {{ site.context_css_classes }}" id='navbar' role='navigation'>
        <div class='container'>
            <div class='navbar-header'>
                <button class='navbar-toggle' data-target='.navbar-header-collapse' data-toggle='collapse' type='button'>
          <span class='sr-only'>
            {{ 'common.toggle_nav' | i18n }}
          </span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <!-- Site logo -->
                {% if site.logo_url != null %}
                <a class='navbar-brand header-logo' href='{{current_school.url | school_link}}'>
                    <span class="sr-only">{{current_school.name}}</span>
                    <img src="{{ site.logo_url }}" alt="{{ current_school.name }}" srcset="{{ site.logo_url_2x }} 2x" />
                </a>
                {% else %}
                <a class='school-title navbar-brand' href='{{current_school.url | school_link}}'>
                    {{ current_school.name}}
                </a>
                {% endif %}

                <!-- Header Menu -->
                <div class='collapse navbar-collapse navbar-header-collapse'>
                    {% include "layouts/partials/header_links" %}
                </div>
            </div>
        </div>
        <div class="container-fluid custom-dropdown">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Writing </h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Technology</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Productivity</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>

                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Oral Advocacy</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Cognitive Science</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Checklists</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{% else %}
<!-- HEADER -->
<header class=''>
    <!-- Navbar -->
    <div class="navbar navbar-fedora navbar-fixed-top is-at-top bs-docs-nav hide-nav-background-color {{ site.context_css_classes }}" id='navbar' role='navigation'>
        <div class='container'>
            <div class='navbar-header'>
                <button class='navbar-toggle' data-target='.navbar-header-collapse' data-toggle='collapse' type='button'>
          <span class='sr-only'>
            {{ 'common.toggle_nav' | i18n }}
          </span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <!-- Site logo -->
                {% if site.logo_url != null %}
                <a class='navbar-brand header-logo' href='{{current_school.url | school_link}}'>
                    <span class="sr-only">{{current_school.name}}</span>
                    <img src="{{ site.logo_url }}" alt="{{ current_school.name }}" srcset="{{ site.logo_url_2x }} 2x" />
                </a>
                {% else %}
                <a class='school-title navbar-brand' href='{{current_school.url | school_link}}'>
                    {{ current_school.name}}
                </a>
                {% endif %}

                <!-- Header Menu -->
                <div class='collapse navbar-collapse navbar-header-collapse'>
                    {% include "layouts/partials/header_links" %}
                </div>
            </div>
        </div>
        <div class="container-fluid custom-dropdown">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Writing </h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Technology</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Productivity</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>

                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Oral Advocacy</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Cognitive Science</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <h4>Checklists</h4>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                        <p><a href="#">Rhetorical Moves</a></p>
                        <p><a href="#">Style Moves</a></p>
                        <p><a href="#">Immutable Rules</a></p>
                        <p><a href="#">Analytical Moves</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{% endif %}