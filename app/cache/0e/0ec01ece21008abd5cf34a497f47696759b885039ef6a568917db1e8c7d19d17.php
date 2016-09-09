<?php

/* login_view.twig */
class __TwigTemplate_80adc58e492a17ec240c1b4770ca9d15c63702803c4dceca836f92fc64e4062f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "login_view.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <h1>Авторизация</h1>
    <div class=\"container\">

        <form class=\"form-signin\" method=\"post\" action=\"do_login/\">
            <h2 class=\"form-signin-heading\">Пожалуйста авторизуйтесь</h2>
            <label for=\"inputEmail\" class=\"sr-only\">Ваш Email</label>
            <input type=\"email\" id=\"inputEmail\" class=\"form-control\" placeholder=\"Email address\" required autofocus>
            <label for=\"inputPassword\" class=\"sr-only\">Пароль</label>
            <input type=\"password\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required>
            <div class=\"checkbox\">
                <label>
                    <input type=\"checkbox\" value=\"remember-me\"> Запомнить меня
                </label>
            </div>
            <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Вход</button>
        </form>

    </div> <!-- /container -->
";
    }

    public function getTemplateName()
    {
        return "login_view.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends "layout.twig" %}*/
/* */
/* {% block content %}*/
/*     <h1>Авторизация</h1>*/
/*     <div class="container">*/
/* */
/*         <form class="form-signin" method="post" action="do_login/">*/
/*             <h2 class="form-signin-heading">Пожалуйста авторизуйтесь</h2>*/
/*             <label for="inputEmail" class="sr-only">Ваш Email</label>*/
/*             <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>*/
/*             <label for="inputPassword" class="sr-only">Пароль</label>*/
/*             <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>*/
/*             <div class="checkbox">*/
/*                 <label>*/
/*                     <input type="checkbox" value="remember-me"> Запомнить меня*/
/*                 </label>*/
/*             </div>*/
/*             <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>*/
/*         </form>*/
/* */
/*     </div> <!-- /container -->*/
/* {% endblock %}*/
