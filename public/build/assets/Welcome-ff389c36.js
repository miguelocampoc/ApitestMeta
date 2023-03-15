import{j as w,H as m,e as s,b as n,a as t,F as u,h as g,I as r,o as l,t as c,w as x,g as B,n as b}from"./app-62178382.js";import O from"./add_modal-749efbd3.js";import L from"./show_modal-4fd52ca9.js";import S from"./addorcid_modal-783ff5f1.js";import E from"./menu-be8f462b.js";import{_ as N}from"./_plugin-vue_export-helper-c27b6911.js";const P={components:{agregar_modal:O,show_modal:L,addorcid_modal:S,Link:w,navbar:E},props:{},created(){this.orcid_list()},methods:{ChangePage(e){m.get(e).then(a=>{console.log(a.data),this.list_orcid=a.data})},confirmationButton(e){Swal.fire({title:"¿Estas Seguro?",html:"<span style='color:white'>No puede revertir esta accion</span>",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Remover",cancelButtonText:"Cancelar"}).then(a=>{a.isConfirmed&&(Swal.fire("Removido","<span style='color:white'>Su archivo ha sido eliminado</span>","success"),this.destroy(e))})},destroy(e){m.delete("api/orcid/delete/"+e).then(a=>{this.ChangePage("api/orcid/list?page="+this.list_orcid.meta.current_page)})},orcid_list(){m.get("api/orcid/list").then(e=>{console.log(e.data),this.list_orcid=e.data})},get_orcid_item(e){this.orcid_item=this.list_orcid.data[e]}},data(){return{url_listar:"/api/orcid/list",list_orcid:[],current_page:"",orcid_item:""}}},V={class:"container-fluid mt-4"},T={class:"card"},A=t("div",{class:"card-header"}," Listar Orcids ",-1),F={class:"card-body"},R=t("div",{class:"button-container mb-4"},[t("button",{type:"button",class:"btn btn-primary","data-bs-toggle":"modal","data-bs-target":"#exampleModal","data-bs-whatever":"@mdo"},"Agregar orcid externo"),t("span",{class:"ml-5"}),t("button",{type:"button",class:"btn btn-primary","data-bs-toggle":"modal","data-bs-target":"#add_orcid","data-bs-whatever":"@mdo"},"Agregar Orcid")],-1),W={class:"table-responsive"},j={class:"table table-striped"},z=t("thead",null,[t("tr",null,[t("th",{scope:"col"},"orcid_identifier"),t("th",{scope:"col"},"given_names"),t("th",{scope:"col"},"family_name"),t("th",{scope:"col"},"email_primary"),t("th",{scope:"col"},"Opciones")])],-1),D={class:"button-container"},H=["onClick"],I=["onClick"],M={class:"card-footer"},q={class:"mt-0 mb-0","aria-label":"Page navigation example"},G={class:"pagination mt-0 mb-0"},J=["onClick"];function K(e,a,Q,U,_,i){var h;const v=r("agregar_modal"),f=r("show_modal"),y=r("addorcid_modal"),C=r("navbar"),k=r("Link");return l(),s(u,null,[n(v,{onOrcid_list_event:i.orcid_list},null,8,["onOrcid_list_event"]),n(f,{orcid_item:_.orcid_item},null,8,["orcid_item"]),n(y,{onOrcid_list_event:i.orcid_list},null,8,["onOrcid_list_event"]),n(C),t("div",V,[t("div",T,[A,t("div",F,[R,t("div",W,[t("table",j,[z,t("tbody",null,[(l(!0),s(u,null,g(_.list_orcid.data,(o,d)=>(l(),s("tr",{key:d},[t("td",null,c(o.orcid_identifier_path),1),t("td",null,c(o.given_names),1),t("td",null,c(o.family_name),1),t("td",null,c(o.email_primary),1),t("td",null,[t("div",D,[t("button",{type:"button",class:"btn btn-primary","data-bs-toggle":"modal",onClick:p=>i.get_orcid_item(d),"data-bs-target":"#staticBackdrop"},"Ver",8,H),t("button",{onClick:p=>i.confirmationButton(o.id),class:"btn btn-primary"}," Eliminar",8,I),n(k,{class:"btn btn-primary",href:"/orcid/edit/"+o.id},{default:x(()=>[B(" Editar")]),_:2},1032,["href"])])])]))),128))])])])]),t("div",M,[t("nav",q,[t("ul",G,[(l(!0),s(u,null,g((h=_.list_orcid.meta)==null?void 0:h.links,(o,d)=>(l(),s("li",{style:{cursor:"pointer"},key:d,class:b(["page-item",{disabled:o.url==null}])},[t("a",{class:b(["page-link",{active:o.active}]),onClick:p=>i.ChangePage(o.url)},c(o.label),11,J)],2))),128))])])])])])],64)}const ot=N(P,[["render",K]]);export{ot as default};
