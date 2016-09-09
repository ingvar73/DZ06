<?php

/* 404_view.twig */
class __TwigTemplate_1641f46546beb8f90d86e948bac7821cc56814f013b770cf58502528670619bc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "404_view.twig", 1);
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
        echo "    <h1>Ошибка - 404!</h1>
    <p>Упс! Данной страницы не существует! Попробуйте начать ваш пусть с <a href=\"/\">главной страницы сайта</a></p>
";
    }

    public function getTemplateName()
    {
        return "404_view.twig";
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
/*     <h1>Ошибка - 404!</h1>*/
/*     <p>Упс! Данной страницы не существует! Попробуйте начать ваш пусть с <a href="/">главной страницы сайта</a></p>*/
/* {% endblock %}*/
