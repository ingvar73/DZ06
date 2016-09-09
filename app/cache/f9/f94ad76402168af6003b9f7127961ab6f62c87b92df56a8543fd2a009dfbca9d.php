<?php

/* signup_view.twig */
class __TwigTemplate_e7181b1b7eb558ac80700fb4a8b22a0cbd4bf1b2817ed68ce195d75a8fb1d996 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "signup_view.twig", 1);
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
        echo "    <h1>Регистрация</h1>
    <div class=\"container\">

        <form class=\"form-signin\" method=\"post\" action=\"do_signup/\" enctype=\"multipart/form-data\">
            <h2 class=\"form-signin-heading\">Пожалуйста зарегистрируйтесь</h2>
            <label for=\"inputEmail\" class=\"sr-only\">Ваш Email</label>
            <input type=\"email\" name=\"email\" id=\"inputEmail\" class=\"form-control\" placeholder=\"Email address\" required autofocus>
            <label for=\"inputLogin\" class=\"sr-only\">Ваш логин</label>
            <input type=\"text\" id=\"inputLogin\" class=\"form-control\" placeholder=\"Login\" required autofocus>
            <label for=\"inputName\" class=\"sr-only\">Ваше имя</label>
            <input type=\"text\" id=\"inputEmail\" class=\"form-control\" placeholder=\"Name\" required autofocus>
            <label for=\"inputEmail\" class=\"sr-only\">Кратко о себе</label>
            <input type=\"textarea\" id=\"inputEmail\" class=\"form-control\" placeholder=\"About\" required autofocus>
            <label for=\"inputPassword\" class=\"sr-only\">Пароль</label>
            <input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required>
            <label for=\"inputCPassword\" class=\"sr-only\">Повторный пароль</label>
            <input type=\"password\" name=\"cpassword\" id=\"inputCPassword\" class=\"form-control\" placeholder=\"CPassword\" required>
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
        return "signup_view.twig";
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
/*     <h1>Регистрация</h1>*/
/*     <div class="container">*/
/* */
/*         <form class="form-signin" method="post" action="do_signup/" enctype="multipart/form-data">*/
/*             <h2 class="form-signin-heading">Пожалуйста зарегистрируйтесь</h2>*/
/*             <label for="inputEmail" class="sr-only">Ваш Email</label>*/
/*             <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>*/
/*             <label for="inputLogin" class="sr-only">Ваш логин</label>*/
/*             <input type="text" id="inputLogin" class="form-control" placeholder="Login" required autofocus>*/
/*             <label for="inputName" class="sr-only">Ваше имя</label>*/
/*             <input type="text" id="inputEmail" class="form-control" placeholder="Name" required autofocus>*/
/*             <label for="inputEmail" class="sr-only">Кратко о себе</label>*/
/*             <input type="textarea" id="inputEmail" class="form-control" placeholder="About" required autofocus>*/
/*             <label for="inputPassword" class="sr-only">Пароль</label>*/
/*             <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>*/
/*             <label for="inputCPassword" class="sr-only">Повторный пароль</label>*/
/*             <input type="password" name="cpassword" id="inputCPassword" class="form-control" placeholder="CPassword" required>*/
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
