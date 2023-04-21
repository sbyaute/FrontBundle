======
Twigcs
======

*FrontBundle* s'appuie sur `GrumPHP <https://github.com/phpro/grumphp>`_ et `Twigcs <https://github.com/friendsoftwig/twigcs>`_ pour maintenir un code de qualité.

Nous vous encourageons à faire de même dans votre projet.
La mise en oeuvre de *GrumpPHP* est documentée dans le projet `SK PHP <http://docs-projet.cnqd.sbyautets.fr/docs/SK-PHP/latest/grumPHP.html>`_.

WARNING Unused variable
=======================

Lors de l'exécution de la tâche *Twigcs*, il est possible que vous rencontriez cette erreur.

Elle peut notamment se produire lors de la `personnalisation du titre de vos pages <http://docs-projet.cnqd.sbyautets.fr/docs/FrontBundle/latest/technique/layout.html#parametrer-les-templates>`_.

Lorsque cette erreur n'est pas justifiée (faux positif), utilisez l'annotation ```use-var```.

.. code-block:: twig

    {% extends 'base.html.twig' %}
    {% set page_title = 'Titre de la page' %}
    {# twigcs use-var page_title #}
    {% block content %}
        ...
    {% endblock %}