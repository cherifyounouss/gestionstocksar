<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Tableau de bord</span></a></li>
                @if ($nb_alertes > 0)
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/notifications')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Notifications <span class="badge badge-pill badge-danger">{{$nb_alertes}}</span></span></a></li>
                @else
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/notifications')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Notifications</span></a></li>
                @endif
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-format-list-bulleted-type"></i><span class="hide-menu">G&eacute;rer le stock</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{url('/stock/ajouter_produit')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Cr&eacute;er un produit </span></a></li>
                        <li class="sidebar-item"><a href="{{url('/stock/liste_produit')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Liste des produits </span></a></li>
                        @foreach($etageres as $etagere)
                        <li class="sidebar-item"><a href="{{url('/stock/liste_produit_etagere',$etagere->libelle)}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Etag&egrave;re {{$etagere->libelle}} </span></a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-format-list-bulleted-type"></i><span class="hide-menu">G&eacute;rer utilisateurs</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Ajouter un nouveau utilisateur </span></a></li>
                            <li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Liste des utilisateurs </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-format-list-bulleted-type"></i><span class="hide-menu">G&eacute;rer fournisseurs</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('/ajouter_fournisseur')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Ajouter un nouveau fournisseur </span></a></li>
                            <li class="sidebar-item"><a href="{{url('/liste_fournisseur')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Liste des fournisseurs </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-format-list-bulleted-type"></i><span class="hide-menu">Approvisionnements</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('/stock/approvisionner')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Approvisoner stock </span></a></li>
                            <li class="sidebar-item"><a href="{{url('/stock/historique_approvisionnement')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Historique approvisionnement</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>