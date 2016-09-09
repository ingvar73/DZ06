<?php

/* layout.twig */
class __TwigTemplate_e80491ef951ef78d34348c88ec27dabf500a6de2aaecdf3bec5700c402ff4eed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"ru\">
<head>
    <meta charset=\"utf-8\"/>
    <title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>
    <link rel=\"stylesheet\" href=\"/assets/template/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"/assets/template/css/bootstrap-theme.min.css\">
</head>
<body>

<nav class=\"navbar navbar-inverse navbar-fixed-top\">
    <div class=\"container\">
        <div id=\"navbar\" class=\"navbar-collapse collapse\">
            <ul class=\"nav navbar-nav\">
                <li><a href=\"/\">Главная</a></li>
                <li><a href=\"/login/\">Вход</a></li>
                <li><a href=\"/signup/\">Регистрация</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class=\"jumbotron\">
    <div class=\"container\">
        ";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        // line 28
        echo "    </div>
</div>

<div class=\"container\">
    <hr>

    <footer>
        <p>© 2016 LoftSchool</p>
    </footer>
</div> <!-- /container -->

<script src=\"https://code.jquery.com/jquery-1.12.4.min.js\"></script>
<script src=\"/assets/template/js/bootstrap.min.js\"></script>
</body>
</html>";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
        // line 27
        echo "        ";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 27,  70 => 26,  52 => 28,  50 => 26,  26 => 5,  20 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="ru">*/
/* <head>*/
/*     <meta charset="utf-8"/>*/
/*     <title>{{ title }}</title>*/
/*     <link rel="stylesheet" href="/assets/template/css/bootstrap.min.css">*/
/*     <link rel="stylesheet" href="/assets/template/css/bootstrap-theme.min.css">*/
/* </head>*/
/* <body>*/
/* */
/* <nav class="navbar navbar-inverse navbar-fixed-top">*/
/*     <div class="container">*/
/*         <div id="navbar" class="navbar-collapse collapse">*/
/*             <ul class="nav navbar-nav">*/
/*                 <li><a href="/">Главная</a></li>*/
/*                 <li><a href="/login/">Вход</a></li>*/
/*                 <li><a href="/signup/">Регистрация</a></li>*/
/*             </ul>*/
/*         </div><!--/.navbar-collapse -->*/
/*     </div>*/
/* </nav>*/
/* */
/* <!-- Main jumbotron for a primary marketing message or call to action -->*/
/* <div class="jumbotron">*/
/*     <div class="container">*/
/*         {% block content %}*/
/*         {% endblock %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="container">*/
/*     <hr>*/
/* */
/*     <footer>*/
/*         <p>© 2016 LoftSchool</p>*/
/*     </footer>*/
/* </div> <!-- /container -->*/
/* */
/* <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>*/
/* <script src="/assets/template/js/bootstrap.min.js"></script>*/
/* </body>*/
/* </html>*/
