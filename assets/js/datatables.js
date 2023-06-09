$.extend(true, $.fn.dataTable.defaults, {
    buttons: [
        {
            extend: 'csv',
            text: 'Export CSV',
            charset: 'utf-8',
            fieldSeparator: ';',
            bom: true,
            exportOptions: {
                columns: ':visible'
            },
        },
        {
            extend: 'print',
            text: 'Imprimer'
        }
    ],
    stateSave: true,
    lengthMenu: [5, 10, 25, 50, 75, 100],
    language: {
        emptyTable: "Aucune donnée disponible dans le tableau",
        info: "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
        infoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément",
        infoFiltered: "(filtré à partir de _MAX_ éléments au total)",
        infoPostFix: "",
        infoThousands: ",",
        lengthMenu: "Afficher _MENU_ éléments",
        loadingRecords: "Chargement...",
        processing: "Traitement...",
        search: "Rechercher :",
        zeroRecords: "Aucun élément correspondant trouvé",
        paginate: {
            first: "Premier",
            last: "Dernier",
            next: "Suivant",
            previous: "Précédent"
        },
        aria: {
            sortAscending: ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        },
        select: {
            rows: {
                _: "%d lignes sélectionnées",
                0: "Aucune ligne sélectionnée",
                1: "1 ligne sélectionnée"
            }
        }
    }
});
