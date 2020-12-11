<?php

namespace App\Tests;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Panther\PantherTestCase;

class ConferenceControllerTest extends PantherTestCase
{
    public function testIndex()
    {
        // A RETIRER !!! $client = static::createClient();
        $client = static::createPantherClient(['external_base_uri' => $_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL']]); // A AJOUTER !!!
        $client->request('GET', '/');

        // Aperçu du contenu de la réponse
//        echo $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Donnez votre avis !');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/bruxelles-2021');
        $client->submitForm('Ajouter', [
            'comment_form[author]' => 'Guy Depaoulizz',
            'comment_form[text]' => 'Encore un commentaire, cette fois, ajouté par le biais d\'un test !',
//            'comment_form[email]' => 'yo@toto.com',
            'comment_form[email]' => $email = 'yo@toto.com',
            'comment_form[photo]' => dirname(__DIR__).'/public/favicon.ico',
        ]);
        $this->assertResponseRedirects();

        // Simuler une validation de commentaire
        $comment = self::$container->getParameter(CommentRepository::class)->findOneByEmail($email);
        $comment->setState('published');
        self::$container->get(EntityManagerInterface::class)->flush();

        $client->followRedirect();
        $this->assertSelectorExists('div:contains("Il y a 2 commentaires :")');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        // GO page d’accueil
        $crawler = $client->request('GET', '/');

        // La méthode request() retourne une instance de Crawler qui aide à trouver des éléments sur la page
        // (comme des liens, des formulaires, ou tout ce que vous pouvez atteindre avec des sélecteurs CSS ou XPath);

        // Grâce à un sélecteur CSS, nous testons que nous avons bien deux conférences listées sur la page d’accueil
        $this->assertCount(2, $crawler->filter('h4'));

        // On clique ensuite sur le lien « View » (comme il n’est pas possible de cliquer sur plus d’un lien à la fois, Symfony choisit automatiquement le premier qu’il trouve)
        $client->clickLink('Détails');
        // Au lieu de cliquer sur le texte "Détails", on peut aussi utiliser le sélecteur CSS :
//        $client->click($crawler->filter('h4 + p a')->link());

        $this->assertPageTitleContains('Bruxelles');
        // Conférence de Bruxelles 2021
        $this->assertResponseIsSuccessful();
        // Nous vérifions le titre de la page, la réponse et le <h2> de la page pour être sûr d’être sur la bonne page (nous aurions aussi pu vérifier la route correspondante);
        $this->assertSelectorTextContains('h2', 'Conférence de Bruxelles 2021');
        // nous vérifions qu’il y a 2 commentaire sur la page. div:contains() n’est pas un sélecteur CSS valide, mais Symfony a quelques ajouts intéressants, empruntés à jQuery.
        $this->assertSelectorExists('div:contains("Il y a 1 commentaires :")');
    }

    public function testMailerAssertions()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertEmailCount(1);
        $event = $this->getMailerEvent(0);
        $this->assertEmailIsQueued($event);

        $email = $this->getMailerMessage(0);
        $this->assertEmailHeaderSame($email, 'to', 'tesdy@example.com');
        $this->assertEmailTextBodyContains($email, 'Bar');
        $this->assertEmailAttachmentCount($email, 1);
    }
}
