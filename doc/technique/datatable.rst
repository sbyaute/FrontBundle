=========
DataTable
=========

FrontBundle inclut le plugin `Jquery DataTables <https://datatables.net>`_ permettant de créer rapidement des tableaux HTML avancés. De plus le thème Bootstrap est lui aussi déjà inclus.

La `documentation DataTable <https://datatables.net/manual/index>`_ est complète, `des exemples <https://datatables.net/examples/index>`_ sont aussi proposés.

DataTable exploite des sources de donnée HTML ou AJAX.

Source de donnée HTML
=====================

La solution la plus facile est de charger les données via une déclaration d'un élément HTML `<table>` et d'y ajouter la classe `dataTable`.

Cependant toutes les données doivent être chargées. Cela peut alourdir rapidement le temps de réponse, la charge sur la base de donnée ou le webservice distant.

Dans la vue Twig d'une page (ex: `./MY_APP/templates/html_table_example/index.html.twig`), ajouter :

.. code-block:: twig

    {% block content %}
        ...
            <table class="table dataTable table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>NIR</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                </tr>
                </thead>
                <tbody>
                {% for example in examples %}
                    <tr id="example_{{ example.id }}">
                        <th>{{ example.nir }}</th>
                        <td>{{ example.lastname }}</td>
                        <td>{{ example.firstname }}</td>
                        <td>{{ example.birthdate|date("d/m/Y") }}</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        ...
    {% endblock %}

Le tableau est généré par `Twig` de manière classique. A noter la présence de :

- attribut class sur l'élément `<table>`, permettant d'ajouter le `style Bootstrap <https://getbootstrap.com/docs/5.2/content/tables/>`_
- élément `<thead>` permet de déclarer l'en-tête des colonnes, un élément `<tfoot>` pourrait aussi être présent
- variable `examples`, fourni par le contrôleur, est un tableau de données. Chaque entrée `example` est un objet `Entity` exposant les méthodes `getNir()`, `getLastname()`, ... . Une entrée pourrait aussi être de type tableau associatif `['nir' => 'value', 'lastname' => ...]`. Plus de détail dans la `documentation Twig variables <https://twig.symfony.com/doc/3.x/templates.html#variables>`_
- attribut id sur les éléments `<tr>`, permet de spécifier le `RowId` utilisé en interne par DataTable. Plus de détail dans la `documentation DataTable row().id <https://datatables.net/reference/api/row().id()>`_

Il est aussi possible d'utiliser un selecteur spécifique pour modifier le comportement par défaut.
Dans la vue Twig de la page (ex: `./MY_APP/templates/html_table_example/index.html.twig`), ajouter :

.. code-block:: twig

    {% block content %}
    ...
        <table id="demo-dataTable" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>NIR</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
            </tr>
            </thead>
            <tbody>
            {% for example in examples %}
                <tr id="example_{{ example.id }}">
                    <th>{{ example.nir }}</th>
                    <td>{{ example.lastname }}</td>
                    <td>{{ example.firstname }}</td>
                    <td>{{ example.birthdate|date("d/m/Y") }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    ...
    {% endblock %}

    {% block javascripts %}
        {{ parent() }}

        <script type="text/javascript">
             window.addEventListener('load', function() {
                $('#demo-dataTable').DataTable({
                    "stateSave": false
                });
            });
        </script>
    {% endblock %}

A noter la présence de :

- `{{ parent() }}` cela ajoute le code à la suite dans le block `javascripts` parent, sans cette instruction le block serait remplacer en totalité. Plus de détail dans la `documentation Twig parent <https://twig.symfony.com/doc/2.x/functions/parent.html>`_
- une fois le document HTML prêt, une instance DataTable est créée sur l'élément HTML `#demo-dataTable`, qui référence l'élément `<table>` préalablement déclaré.

Configuration DataTable
=======================

DataTable est un composant hautement configurable, comme on peut le voir dans sa `liste d'options <https://datatables.net/reference/option/>`_.

Un objet d'option est à fournir au moment de l'instanciation :

.. code-block:: twig

    {% block javascripts %}
        {{ parent() }}

        <script type="text/javascript">
            window.addEventListener('load', function() {
                $('#demo-dataTable').DataTable({
                    ordering: false,
                    paging: false,
                    searching: false
                });
            });
        </script>
    {% endblock %}

Dans cet exemple, on désactive la possibilité d'ordonner, de paginer et de rechercher.

Les exemples sont un bon moyen de découvrir les capacités de DataTable :

- modifier `l'affichage d'une valeur <https://datatables.net/examples/basic_init/data_rendering.html>`_ ou `d'une ligne <https://datatables.net/examples/advanced_init/row_callback.html>`_
- calculer des `colonnes dynamiquement <https://datatables.net/examples/advanced_init/column_render.html>`_
- réagir à des `événements spécifiques <https://datatables.net/examples/advanced_init/dt_events.html>`_
- ajouter des `filtres par colonne <https://datatables.net/examples/api/multi_filter_select.html>`_
- ajouter `un détail par ligne <https://datatables.net/examples/api/row_details.html>`_
- ajouter `une sélection de ligne <https://datatables.net/examples/api/select_single_row.html>`_

Les extensions suivantes sont directement disponibles :

- Boutons (CSV et imprimer) : `Buttons <https://datatables.net/extensions/buttons/>`_

Pour ajouter les boutons il ajouter *B* à la propriété *dom* par exemple :

.. code-block:: twig

    {% block javascripts %}
        {{ parent() }}

        <script type="text/javascript">
            window.addEventListener('load', function() {
                $('#demo-dataTable').DataTable({
                    dom: 'Blfrtip'
                });
            });
        </script>
    {% endblock %}

`Documentation propriété dom <https://datatables.net/reference/option/dom>`_

D'autres sont disponibles sur la page des `plugins <https://datatables.net/plug-ins/index>`_ et des `extensions <https://datatables.net/extensions/index>`_ .
Si vous souhaitez ajouter de nouvelles extensions, nous vous encourageons vivement à proposer votre propre *Merge Request* directement dans le projet `GitLab <https://gitlab.cnqd.sbyautets.fr/STARTER_KIT_PHP-2015/Bundles/FrontBundle>`_.
L'équipe *SKPHP* vous aidera dans cette démarche.

Source de donnée AJAX
=====================

Vue
---

Le chargement des données via AJAX nécessite d'ajouter une route fournissant les données.

Le code HTML est simplifié car les données ne sont plus chargées dans l'élément `<tbody>`.

.. code-block:: twig

    {% block content %}
        ...

        <table id="demo-dataTable" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>NIR</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Date de naissance</td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        ...
    {% endblock %}

Les options Javascript doivent précisées :

- un chargement coté serveur via `serverSide`
- l'affichage d'un message durant le chargement via `processing`
- l'utilisation d'une route, ici `/ajax-table-example/data`, via `ajax`
- l'utilisation de l'attribut en tant que `rowId` comme vu précédemment, ici `id`
- une description des données à utiliser via `columns`. L'option `data` précise le nom de la propriété lue depuis la réponse Ajax. L'option `name` précise le nom de la propriété attendues lors de la requête Ajax.

Plus d'information sont disponibles dans la documentation DataTable option <https://datatables.net/reference/option>`_.

.. code-block:: twig

    {% block javascripts %}
        {{ parent() }}

        <script type="text/javascript">
            window.addEventListener('load', function() {
                $('#demo-dataTable').DataTable({
                    "serverSide": true,
                    "processing": true,
                    "ajax": "/ajax-table-example/data",
                    "rowId": "id",
                    "columns": [
                        {
                            "data": "nir",
                            "name": "nir"
                        },
                        {
                            "data": "lastName",
                            "name": "lastName"
                        },
                        {
                            "data": "firstName",
                            "name": "firstName"
                        },
                        {
                            "data": "birthDate",
                            "name": "birthDate"
                        }
                    ]
                });
            });
        </script>
    {% endblock %}

Contrôleur
----------

Un route GET doit être implémentée, ici `/ajax-table-example/data`. Pour cela 2 outils sont fournis par FrontBundle :

- `DataTableParamsConverter` permet de transformer la requête HTTP provenant de DataTable en objet PHP `DatatableQuery`
- `DataTableResponse` permet de transformer les données trouvées dans le format attendu par DataTable

Voici un exemple d'implémentation possible :

.. code-block:: php

    <?php

    namespace App\Controller;

    use App\Repository\ExampleRepository;
    use Sbyaute\FrontBundle\Table\DataTableQuery;
    use Sbyaute\FrontBundle\Table\DataTableResponse;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AjaxTableExampleController extends AbstractController
    {
        /** @var ExampleRepository */
        private $exampleRepository;

        public function __construct(ExampleRepository $exampleRepository)
        {
            $this->exampleRepository = $exampleRepository;
        }

        /**
        * @Route("/ajax-table-example", name="ajax_table_example", methods={"GET"})
        */
        public function index(): Response
        {
            return $this->render('ajax_table_example/index.html.twig');
        }

        /**
        * @Route("/ajax-table-example/data", name="ajax_table_data", methods={"GET"})
        * @ParamConverter("tableQuery", class="Sbyaute\FrontBundle\Table\DataTableQuery")
        */
        public function data(DataTableQuery $tableQuery): Response
        {
            $data = $this->exampleRepository->findByTableQuery($tableQuery);

            $dataTableResponse = new DataTableResponse($tableQuery, $data, count($data));

            return $this->json($dataTableResponse);
        }
    }

L'action `data` implémente la route `ajax-table-example/data`. 4 éléments sont importants :

- l'action utilise l'annotation `@ParamConverter` pour injecter un objet `$tableQuery` de type `DataTableQuery`
- un `repository` récupère les données à partir de l'objet `$tableQuery`
- un objet `$dataTableResponse` de type `DataTableResponse` encapsule les données trouvées
- la réponse JSON est créée à partir de l'objet `$dataTableResponse`

Plus d'information sur `ParamConverter dans la documentation Symfony <https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html>`_

L'objet `DataTableResponse` prend plusieurs paramètres :

- la requête DataTable, notamment pour l'information `draw <https://datatables.net/manual/server-side>`_
- un itérable, peut être une collection d'objet, un tableau de tableau, etc
- un entier représentant le nombre de résultat non paginé

Il est aussi possible de spécifier un nombre de résultat non filtré via la méthode `setDataUnfilteredCount`. Ce nombre sera affiché dans le message de pagination.

De plus un message d'erreur peut aussi être défini via `setErrorMessage`, au quel cas une erreur devra être gérée par DataTable.

Modèle
------

La partie modèle est ici implémentée par un repository Doctrine, classique dans un environnement Symfony.

.. code-block:: php

    <?php

    namespace App\Repository;

    use App\Entity\Example;
    use Sbyaute\FrontBundle\Table\QueryInterface;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\ORM\Tools\Pagination\Paginator;
    use Doctrine\Persistence\ManagerRegistry;

    /**
    * @method Example|null find($id, $lockMode = null, $lockVersion = null)
    * @method Example|null findOneBy(array $criteria, array $orderBy = null)
    * @method Example[]    findAll()
    * @method Example[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    */
    class ExampleRepository extends ServiceEntityRepository
    {
        public function __construct(ManagerRegistry $registry)
        {
            parent::__construct($registry, Example::class);
        }

        public function findByTableQuery(QueryInterface $tableQuery): Paginator
        {
            $queryBuilder = $this->createQueryBuilder('e');

            // @TODO Implement search criteria you want
            if (strlen($tableQuery->getSearch())) {
                $queryBuilder->andWhere('e.firstName LIKE :search OR e.lastName LIKE :search')
                            ->setParameter('search', '%' . $tableQuery->getSearch(). '%')
                ;
            }

            // @TODO Implement filters you want
            foreach ($tableQuery->getColumnFilters() as $filter) {
                $filterName = 'fitler'.$filter->getColumnName();
                $queryBuilder->andWhere('e.'.$filter->getColumnName().' LIKE :'.$filterName)
                    ->setParameter($filterName, '%'.$filter->getFilterValue().'%');
            }

            // @TODO Implement order criteria you want
            foreach ($tableQuery->getColumnOrders() as $order) {
                $queryBuilder->addOrderBy('e.' . $order->getColumnName(), $order->isAscending() ? 'asc' : 'desc');
            }

            $limit = $tableQuery->getLimit();
            if (-1 != $limit) {
                $queryBuilder->setMaxResults($tableQuery->getLimit());
            }
            $queryBuilder->setFirstResult($tableQuery->getOffset());

            return new Paginator($queryBuilder->getQuery());
        }
    }

`findByTableQuery` exploite l'objet `$tableQuery` pour construire la requête Doctrine via `QueryBuilder`.

A noter les méthodes suivantes :

- `getSearch` - critère recherche
- `getColumnOrders` - ordre et sens des colonnes
- `getLimit` - nombre de résultat souhaité
- `getOffset` - déplacement dans la pagination
- `getColumnFilters` - critère recherche par colonnes

Pour éviter une dépendance à DataTable, l'utilisation de l'interface `QueryInterface` est recommandée. `DataTableQuery` implémente `QueryInterface`. Cela permettrait de changer l'implémentation DataTable sans modifier l'implémentation du repository.
