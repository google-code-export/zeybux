function GestionComptesSpeciauxTemplate(){this.listeComptes='<div id="contenu" class="ui-helper-reset"><div id="liste-compte"><ul><li><a href="#liste-administrateur">Comptes Administrateur</a></li><li><a href="#liste-caisse">Comptes Caisse</a></li><li><a href="#liste-solidaire">Comptes Solidaire</a></li></ul><div id="liste-administrateur"><div id="liste-adh-recherche" class="recherche com-widget-header ui-widget ui-widget-header ui-corner-all"><form id="filter-form-administrateur"><div><span class="conteneur-icon com-float-left ui-widget-content ui-corner-left" title="Chercher"><span class="ui-icon ui-icon-search"></span></span><input class="com-input-text ui-widget-content ui-corner-right filter" name="filter-administrateur" id="filter-administrateur" value="" maxlength="30" size="15" type="text" /></div></form></div><table class="com-table table-administrateur"><thead><tr class="ui-widget ui-widget-header"><th colspan="3" class="com-table-th-debut com-underline-hover com-cursor-pointer"><span class="ui-icon span-icon"></span>Login</th><th class="com-table-th-fin"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all" id="btn-nv-administrateur" title="Ajouter un compte administrateur"><span class="ui-icon ui-icon-plusthick"></span></th></span></tr></thead><tbody><!-- BEGIN administrateur --><tr class="compte-ligne-administrateur" ><td class="com-table-td-debut">{administrateur.login}</td><td class="com-table-td-med com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier" title="Modifier" id-compte="{administrateur.id}" login="{administrateur.login}"><span class="ui-icon ui-icon-pencil"></span></span></td><td class="com-table-td-med com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass" title="Modifier le mot de passe" id-compte="{administrateur.id}"><span class="ui-icon ui-icon-key"></span></span></td><td class="com-table-td-fin com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Supprimer" id-compte="{administrateur.id}" login="{administrateur.login}"><span class="ui-icon ui-icon-trash"></span></span></td></tr><!-- END administrateur --></tbody></table></div><div id="liste-caisse"><div id="liste-adh-recherche" class="recherche com-widget-header ui-widget ui-widget-header ui-corner-all"><form id="filter-form-caisse"><div><span class="conteneur-icon com-float-left ui-widget-content ui-corner-left" title="Chercher"><span class="ui-icon ui-icon-search"></span></span><input class="com-input-text ui-widget-content ui-corner-right filter" name="filter-caisse" id="filter-caisse" value="" maxlength="30" size="15" type="text" /></div></form></div><table class="com-table table-caisse"><thead><tr class="ui-widget ui-widget-header"><th colspan="3" class="com-table-th-debut com-underline-hover com-cursor-pointer"><span class="ui-icon span-icon"></span>Login</th><th class="com-table-th-fin"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all" id="btn-nv-caisse" title="Ajouter un compte caisse"><span class="ui-icon ui-icon-plusthick"></span></th></tr></thead><tbody><!-- BEGIN caisse --><tr class="compte-ligne-caisse" ><td class="com-table-td-debut">{caisse.login}</td><td class="com-table-td-med com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier" title="Modifier" id-compte="{caisse.id}" login="{caisse.login}"><span class="ui-icon ui-icon-pencil"></span></span></td><td class="com-table-td-med com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass" title="Modifier le mot de passe" id-compte="{caisse.id}"><span class="ui-icon ui-icon-key"></span></span></td><td class="com-table-td-fin com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Supprimer" id-compte="{caisse.id}" login="{caisse.login}"><span class="ui-icon ui-icon-trash"></span></span></td></tr><!-- END caisse --></tbody></table></div><div id="liste-solidaire"><div id="liste-adh-recherche" class="recherche com-widget-header ui-widget ui-widget-header ui-corner-all"><form id="filter-form-solidaire"><div><span class="conteneur-icon com-float-left ui-widget-content ui-corner-left" title="Chercher"><span class="ui-icon ui-icon-search"></span></span><input class="com-input-text ui-widget-content ui-corner-right filter" name="filter-solidaire" id="filter-solidaire" value="" maxlength="30" size="15" type="text" /></div></form></div><table class="com-table table-solidaire"><thead><tr class="ui-widget ui-widget-header"><th colspan="3" class="com-table-th-debut com-underline-hover com-cursor-pointer"><span class="ui-icon span-icon"></span>Login</th><th class="com-table-th-fin"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all" id="btn-nv-solidaire" title="Ajouter un compte solidaire"><span class="ui-icon ui-icon-plusthick"></span></th></tr></thead><tbody><!-- BEGIN solidaire --><tr class="compte-ligne-solidaire" ><td class="com-table-td-debut">{solidaire.login}</td><td class="com-table-td-med com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier" title="Modifier" id-compte="{solidaire.id}" login="{solidaire.login}"><span class="ui-icon ui-icon-pencil"></span></span></td><td class="com-table-td-med com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-modifier-pass" title="Modifier le mot de passe" id-compte="{solidaire.id}"><span class="ui-icon ui-icon-key"></span></span></td><td class="com-table-td-fin com-underline-hover td-edt"><span class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Supprimer" id-compte="{solidaire.id}" login="{solidaire.login}"><span class="ui-icon ui-icon-trash"></span></span></td></tr><!-- END solidaire --></tbody></table></div></div></div>';this.listeAdministrateurVide='<div id="liste-administrateur"><p id="texte-liste-vide"><button class="com-btn-edt ui-state-default ui-corner-all com-button com-center" id="btn-nv-administrateur">Ajouter un compte administrateur</button></p></div>';this.listeCaisseVide='<div id="liste-caisse"><p id="texte-liste-vide"><button class="com-btn-edt ui-state-default ui-corner-all com-button com-center" id="btn-nv-caisse">Ajouter un compte caisse</button></p></div>';this.listeSolidaireVide='<div id="liste-solidaire"><p id="texte-liste-vide"><button class="com-btn-edt ui-state-default ui-corner-all com-button com-center" id="btn-nv-solidaire">Ajouter un compte solidaire</button></p></div>';this.dialogAjoutCompte='<div id="dialog-ajout-compte" title="Ajouter un compte {typeCompte}" class="formulaire_identification"><form><table><tr><th class="com-table-form-th ui-widget-content ui-corner-all">Login *</th><td class="com-table-form-td"><input class="input_formulaire_identification com-input-text ui-widget-content ui-corner-all" type="text" name="login" maxlength="20" id="login"/></td></tr><tr><th class="com-table-form-th ui-widget-content ui-corner-all">Mot de Passe *</th><td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass" maxlength="100" id="motPasse"/></td></tr><tr><th class="com-table-form-th ui-widget-content ui-corner-all">Confirmer *</th><td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass_confirm" maxlength="100" id="motPasseConfirm"/></td></tr></table></form></div>';this.dialogUpdate='<div id="dialog-modif-compte" title="Modifier un compte" class="formulaire_identification"><table><tr><th class="com-table-form-th ui-widget-content ui-corner-all">Login *</th><td class="com-table-form-td"><input class="input_formulaire_identification com-input-text ui-widget-content ui-corner-all" type="text" name="login" maxlength="20" id="login" value="{login}" /></td></tr></table></div>';this.dialogUpdatePass='<div id="dialog-modif-compte" title="Modifier le mot de passe" class="formulaire_identification"><form><table><tr><th class="com-table-form-th ui-widget-content ui-corner-all">Nouveau mot de Passe *</th><td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass" maxlength="100" id="motPasse"/></td></tr><tr><th class="com-table-form-th ui-widget-content ui-corner-all">Confirmer *</th><td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass_confirm" maxlength="100" id="motPasseConfirm" /></td></tr></table></form></div>';this.dialogDelete='<div id="dialog-sup-compte" title="Supprimer un compte" class="formulaire_identification"><p class="ui-state-error ui-corner-all"><span class="ui-icon ui-icon-alert com-float-left"></span>ATTENTION : Voulez-vous réellement supprimer le compte : {login}</p></div>'}function ListeComptesSpeciauxVue(a){this.construct=function(b){$.history({vue:function(){ListeComptesSpeciauxVue(b)}});var c=this;$.post("./index.php?m=GestionComptesSpeciaux&v=ListeCompte",function(d){Infobulle.init();if(d){if(d.valid){if(b&&b.vr){Infobulle.generer(b.vr,"")}c.afficher(d)}else{Infobulle.generer(d,"")}}},"json")};this.afficher=function(e){var d=this;var c=new GestionComptesSpeciauxTemplate();var f=c.listeComptes;var b=$(f.template(e));if(e.administrateur.length<=0||e.administrateur[0].id==null){b.find("#liste-administrateur").replaceWith(c.listeAdministrateurVide)}if(e.caisse.length<=0||e.caisse[0].id==null){b.find("#liste-caisse").replaceWith(c.listeCaisseVide)}if(e.solidaire.length<=0||e.solidaire[0].id==null){b.find("#liste-solidaire").replaceWith(c.listeSolidaireVide)}$("#contenu").replaceWith(d.affect(b))};this.affect=function(b){b=this.affectTri(b);b=this.affectRecherche(b);b=this.affectTabs(b);b=gCommunVue.comHoverBtn(b);b=this.affectAjoutCompte(b);b=this.affectUpdateCompte(b);b=this.affectUpdatePassCompte(b);b=this.affectDeleteCompte(b);return b};this.affectTabs=function(b){b.find("#liste-compte").tabs();return b};this.affectTri=function(b){b.find(".table-administrateur").tablesorter({sortList:[[0,0]],headers:{2:{sorter:false},3:{sorter:false}}});b.find(".table-caisse").tablesorter({sortList:[[0,0]],headers:{2:{sorter:false},3:{sorter:false}}});b.find(".table-solidaire").tablesorter({sortList:[[0,0]],headers:{2:{sorter:false},3:{sorter:false}}});return b};this.affectRecherche=function(b){b.find("#filter-administrateur").keyup(function(){$.uiTableFilter($(".table-administrateur"),this.value)});b.find("#filter-caisse").keyup(function(){$.uiTableFilter($(".table-caisse"),this.value)});b.find("#filter-solidaire").keyup(function(){$.uiTableFilter($(".table-solidaire"),this.value)});b.find("#filter-form-administrateur, #filter-form-caisse, #filter-form-solidaire").submit(function(){return false});return b};this.affectAjoutCompte=function(b){var c=this;b.find("#btn-nv-administrateur").click(function(){c.dialogAjoutCompte(2)});b.find("#btn-nv-caisse").click(function(){c.dialogAjoutCompte(3)});b.find("#btn-nv-solidaire").click(function(){c.dialogAjoutCompte(4)});return b};this.dialogAjoutCompte=function(c){var e=this;var b={typeCompte:""};switch(c){case 2:b.typeCompte="administrateur";break;case 3:b.typeCompte="caisse";break;case 3:b.typeCompte="solidaire";break}var d=new GestionComptesSpeciauxTemplate();var f=d.dialogAjoutCompte;lDialog=$(f.template(b)).dialog({autoOpen:true,modal:true,draggable:false,resizable:false,width:540,buttons:{Valider:function(){e.ajoutCompte($(this),c)},Annuler:function(){$(this).dialog("close")}},close:function(g,h){$(this).remove()}});lDialog.find(":input").keyup(function(g){if(g.keyCode=="13"){e.ajoutCompte($(lDialog),c)}})};this.ajoutCompte=function(b,d){var f=this;var c=new CompteSpecialVO();c.login=b.find("#login").val();c.motPasse=b.find("#motPasse").val();c.motPasseConfirm=b.find("#motPasseConfirm").val();c.type=d;var e=new CompteSpecialValid();var g=e.validAjout(c);Infobulle.init();if(g.valid){c.fonction="ajouter";$.post("./index.php?m=GestionComptesSpeciaux&v=Gestion","pParam="+$.toJSON(c),function(i){Infobulle.init();if(i){if(i.valid){var j=new TemplateVR();j.valid=false;j.log.valid=false;var h=new VRerreur();h.code=ERR_339_CODE;h.message=ERR_339_MSG;j.log.erreurs.push(h);$(b).dialog("close");f.construct({vr:j})}else{Infobulle.generer(i,"")}}},"json")}else{Infobulle.generer(g,"")}};this.affectUpdateCompte=function(b){var c=this;b.find(".btn-edt-modifier").click(function(){c.dialogUpdateCompte($(this))});return b};this.dialogUpdateCompte=function(b){var f=this;var e=b.attr("id-compte");var c={login:b.attr("login")};var d=new GestionComptesSpeciauxTemplate();var g=d.dialogUpdate;lDialog=$(g.template(c)).dialog({autoOpen:true,modal:true,draggable:false,resizable:false,width:540,buttons:{Valider:function(){f.updateCompte($(this),e)},Annuler:function(){$(this).dialog("close")}},close:function(h,i){$(this).remove()}});lDialog.find(":input").keyup(function(h){if(h.keyCode=="13"){f.updateCompte($(lDialog),e);return false}})};this.updateCompte=function(b,d){var f=this;var c=new CompteSpecialVO();c.id=d;c.login=b.find("#login").val();var e=new CompteSpecialValid();var g=e.validUpdate(c);Infobulle.init();if(g.valid){c.fonction="modifier";$.post("./index.php?m=GestionComptesSpeciaux&v=Gestion","pParam="+$.toJSON(c),function(i){Infobulle.init();if(i){if(i.valid){var j=new TemplateVR();j.valid=false;j.log.valid=false;var h=new VRerreur();h.code=ERR_340_CODE;h.message=ERR_340_MSG;j.log.erreurs.push(h);$(b).dialog("close");f.construct({vr:j})}else{Infobulle.generer(i,"")}}},"json")}else{Infobulle.generer(g,"")}};this.affectUpdatePassCompte=function(b){var c=this;b.find(".btn-edt-modifier-pass").click(function(){c.dialogUpdatePassCompte($(this))});return b};this.dialogUpdatePassCompte=function(b){var e=this;var d=b.attr("id-compte");var c=new GestionComptesSpeciauxTemplate();var f=c.dialogUpdatePass;lDialog=$(f).dialog({autoOpen:true,modal:true,draggable:false,resizable:false,width:540,buttons:{Valider:function(){e.updatePassCompte($(this),d)},Annuler:function(){$(this).dialog("close")}},close:function(g,h){$(this).remove()}});lDialog.find(":input").keyup(function(g){if(g.keyCode=="13"){e.updatePassCompte($(lDialog),d)}}).find("form").submit(function(){return false})};this.updatePassCompte=function(b,d){var f=this;var c=new CompteSpecialVO();c.id=d;c.motPasse=b.find("#motPasse").val();c.motPasseConfirm=b.find("#motPasseConfirm").val();var e=new CompteSpecialValid();var g=e.validUpdatePass(c);Infobulle.init();if(g.valid){c.fonction="modifierPass";$.post("./index.php?m=GestionComptesSpeciaux&v=Gestion","pParam="+$.toJSON(c),function(i){Infobulle.init();if(i){if(i.valid){var j=new TemplateVR();j.valid=false;j.log.valid=false;var h=new VRerreur();h.code=ERR_340_CODE;h.message=ERR_340_MSG;j.log.erreurs.push(h);$(b).dialog("close");f.construct({vr:j})}else{Infobulle.generer(i,"")}}},"json")}else{Infobulle.generer(g,"")}};this.affectDeleteCompte=function(b){var c=this;b.find(".btn-edt-supprimer").click(function(){c.dialogDeleteCompte($(this))});return b};this.dialogDeleteCompte=function(b){var f=this;var e=b.attr("id-compte");var c={login:b.attr("login")};var d=new GestionComptesSpeciauxTemplate();var g=d.dialogDelete;$(g.template(c)).dialog({autoOpen:true,modal:true,draggable:false,resizable:false,width:640,buttons:{Valider:function(){f.deleteCompte($(this),e)},Annuler:function(){$(this).dialog("close")}},close:function(h,i){$(this).remove()}})};this.deleteCompte=function(b,d){var f=this;var c=new CompteSpecialVO();c.id=d;var e=new CompteSpecialValid();var g=e.validDelete(c);Infobulle.init();if(g.valid){c.fonction="supprimer";$.post("./index.php?m=GestionComptesSpeciaux&v=Gestion","pParam="+$.toJSON(c),function(i){Infobulle.init();if(i){if(i.valid){var j=new TemplateVR();j.valid=false;j.log.valid=false;var h=new VRerreur();h.code=ERR_341_CODE;h.message=ERR_341_MSG;j.log.erreurs.push(h);$(b).dialog("close");f.construct({vr:j})}else{Infobulle.generer(i,"")}}},"json")}else{Infobulle.generer(g,"")}};this.construct(a)};