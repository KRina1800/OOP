<?php
require __DIR__ . '/../vendor/autoload.php';

interface TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate;
    public function createPageTemplate(): PageTemplate;
    public function getRenderer(): TemplateRenderer;
}

interface TitleTemplate
{
    public function getTemplateString(): string;
}

interface PageTemplate
{
    public function getTemplateString(): string;
}

interface TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string;
}

abstract class BasePageTemplate implements PageTemplate {
    protected TitleTemplate $titleTemplate;

    public function __construct(TitleTemplate $titleTemplate) {
        $this->titleTemplate = $titleTemplate;
    }
}

/* -----TWIG ----- */
class TwigTemplateFactory implements TemplateFactory {
    public function createTitleTemplate(): TitleTemplate
    {
        return new TwigTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new TwigPageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        return new TwigRenderer();
    }
}
class TwigTitleTemplate implements TitleTemplate {
    public function getTemplateString(): string {
        return "<h1>{{ title }}</h1>";
    }
}

class TwigPageTemplate extends BasePageTemplate {
    public function getTemplateString(): string {
        $title = $this->titleTemplate->getTemplateString();
        return <<<HTML
            <div class="page">
                $title
                <article class="content">
                    {{ content }}
                </article>
            </div>
HTML;

    }
}

class TwigRenderer implements TemplateRenderer {
    public function render(string $templateString, array $arguments = []): string
    {
        $loader = new Twig\Loader\ArrayLoader([
            'base.html' => $templateString
        ]);
        $twig = new Twig\Environment($loader);
        return $twig->load('base.html')->render($arguments);
    }
}
/* -----TWIG ----- */

/* -----PHP------*/
class PHPTemplateFactory implements TemplateFactory {
    public function createTitleTemplate(): TitleTemplate
    {
        return new PHPTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new PHPPageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        return new PHPTemplateRenderer();
    }
}
class PHPTitleTemplate implements TitleTemplate {
    public function getTemplateString(): string {
        return '<h1><?= $title ?></h1>';
    }
}

class PHPPageTemplate extends BasePageTemplate {
    public function getTemplateString(): string {
        $title = $this->titleTemplate->getTemplateString();
        return '
            <div class="page">
            ' . $title . '
            <article class="content">
                <?= $content ?>
            </article>
        </div>';
    }
}

class PHPTemplateRenderer implements TemplateRenderer {
    public function render(string $templateString, array $arguments = []): string {
        extract($arguments);
        ob_start();
        eval('?>' . $templateString . '<?php');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}
/* -----PHP------*/

class Page {
    protected string $title;
    protected string $content;

    public function __construct(string $title, string $content) {
        $this->title = $title;
        $this->content = $content;
    }

    public function render(TemplateFactory $factory): string
    {
        $pageTemplate = $factory->createPageTemplate();
        $renderer = $factory->getRenderer();
        return $renderer->render($pageTemplate->getTemplateString(), [
            'title' => $this->title,
            'content' => $this->content
        ]);
    }
}


$page = new Page('MyFirst Page 2', 'Hello world! 3 My name is Job');
echo $page->render(new TwigTemplateFactory());
