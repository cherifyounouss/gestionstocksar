<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Tableau de bord</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-clipboard-alert"></i><span class="hide-menu">Notifications
                    @if ($nb_alertes > 0)
                    <span class="badge badge-pill badge-danger">{{$nb_alertes}}</span>
                    @endif
                    </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('/notifications/alerte_stock')}}" class="sidebar-link"><i class="mdi mdi-alert-circle-outline"></i><span class="hide-menu"> Alertes stock
                            @if ($nb_produits_en_rupt > 0)
                            <span class="badge badge-pill badge-danger">{{$nb_produits_en_rupt}}</span>
                            @endif
                            </span></a></li>
                            <li class="sidebar-item"><a href="{{url('/notifications/alerte_peremption')}}" class="sidebar-link"><i class="mdi mdi-alert-circle-outline"></i><span class="hide-menu"> Alertes date de p&eacute;remption
                            @if ($nb_produits_en_per > 0)
                            <span class="badge badge-pill badge-danger">{{$nb_produits_en_per}}</span>
                            @endif    
                            </span></a></li>
                    </ul>
                </li>
                @if (auth()->guard('utilisateur')->user()->can('creer produit') && auth()->guard('utilisateur')->user()->can('lister produit'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-package-variant"></i><span class="hide-menu">G&eacute;rer le stock</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @if (auth()->guard('utilisateur')->user()->can('creer produit'))
                        <li class="sidebar-item"><a href="{{url('/stock/ajouter_produit')}}" class="sidebar-link"><i class="mdi mdi-plus-circle-outline"></i><span class="hide-menu"> Cr&eacute;er un produit </span></a></li>
                        @endif
                        @if (auth()->guard('utilisateur')->user()->can('lister produit'))
                        <li class="sidebar-item"><a href="{{url('/stock/liste_produit')}}" class="sidebar-link"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu"> Liste des produits </span></a></li>
                        @foreach($etageres as $etagere)
                        <li class="sidebar-item"><a href="{{url('/stock/liste_produit_etagere',$etagere->libelle)}}" class="sidebar-link"><i class="mdi mdi-cube"></i><span class="hide-menu"> Etag&egrave;re {{$etagere->libelle}} </span></a></li>
                        @endforeach
                        @endif
                    </ul>
                </li>
                @endif
                @if (auth()->guard('utilisateur')->user()->can('gerer utilisateur'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">G&eacute;rer utilisateurs</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('/ajouter_utilisateur')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> Ajouter un nouveau utilisateur </span></a></li>
                            <li class="sidebar-item"><a href="{{url('/liste_utilisateur')}}" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> Liste des utilisateurs </span></a></li>
                    </ul>
                </li>
                @endif
                @if (auth()->guard('utilisateur')->user()->can('creer fournisseur') && auth()->guard('utilisateur')->user()->can('lister fournisseur'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">G&eacute;rer fournisseurs</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @if (auth()->guard('utilisateur')->user()->can('creer fournisseur'))
                        <li class="sidebar-item"><a href="{{url('/ajouter_fournisseur')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> Ajouter un nouveau fournisseur </span></a></li>
                        @endif
                        @if (auth()->guard('utilisateur')->user()->can('lister fournisseur'))
                        <li class="sidebar-item"><a href="{{url('/liste_fournisseur')}}" class="sidebar-link"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu"> Liste des fournisseurs </span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (auth()->guard('utilisateur')->user()->can('creer etagere') && auth()->guard('utilisateur')->user()->can('lister etagere'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-table-large"></i><span class="hide-menu">G&eacute;rer les &eacute;tag&egrave;res</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @if (auth()->guard('utilisateur')->user()->can('creer etagere'))
                        <li class="sidebar-item"><a href="{{url('/stock/ajouter_etagere')}}" class="sidebar-link"><i class="mdi mdi-plus-circle-outline"></i><span class="hide-menu"> Ajouter une nouvelle &eacute;tag&egrave;re </span></a></li>
                        @endif
                        @if (auth()->guard('utilisateur')->user()->can('lister etagere'))
                        <li class="sidebar-item"><a href="{{url('/stock/liste_etagere')}}" class="sidebar-link"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu"> Liste des &eacute;tag&egrave;res</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (auth()->guard('utilisateur')->user()->can('approvisionner stock') && auth()->guard('utilisateur')->user()->can('voir historique approvisionnement'))       
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Approvisionnements</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @if (auth()->guard('utilisateur')->user()->can('approvisionner stock'))
                        <li class="sidebar-item"><a href="{{url('/stock/approvisionner')}}" class="sidebar-link"><i class="mdi mdi-arrow-down"></i><span class="hide-menu"> Approvisoner stock </span></a></li>
                        @endif
                        @if (auth()->guard('utilisateur')->user()->can('voir historique approvisionnement'))
                        <li class="sidebar-item"><a href="{{url('/stock/historique_approvisionnement')}}" class="sidebar-link"><i class="mdi mdi-history"></i><span class="hide-menu"> Historique approvisionnement</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (auth()->guard('utilisateur')->user()->can('enregistrer consommation') && auth()->guard('utilisateur')->user()->can('voir historique consommation'))       
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-arrow-up-drop-circle-outline"></i><span class="hide-menu">Consommations</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @if (auth()->guard('utilisateur')->user()->can('enregistrer consommation'))
                        <li class="sidebar-item"><a href="{{url('/stock/consommer')}}" class="sidebar-link"><i class="mdi mdi-arrow-up"></i><span class="hide-menu"> Enregistrer une consommation </span></a></li>
                        @endif
                        @if (auth()->guard('utilisateur')->user()->can('voir historique consommation'))
                        <li class="sidebar-item"><a href="{{url('/stock/historique_consommation')}}" class="sidebar-link"><i class="mdi mdi-history"></i><span class="hide-menu"> Historique consommation</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (auth()->guard('utilisateur')->user()->can('gerer role'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect has-arrow waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-key"></i><span class="hide-menu">G&eacute;rer les r&ocirc;les</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{url('/ajouter_role')}}" class="sidebar-link"><i class="mdi mdi-plus-circle-outline"></i><span class="hide-menu"> Ajouter un r&ocirc;le </span></a></li>
                        <li class="sidebar-item"><a href="{{url('/liste_role')}}" class="sidebar-link"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu"> Liste des r&ocir;les</span></a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>