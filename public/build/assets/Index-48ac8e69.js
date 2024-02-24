import{T as B,l as y,h as E,o as f,c as _,b as l,F as b,k as j,t as x,a as o,e as w,u as t,d as A,j as M}from"./app-1d5307ec.js";import{t as p}from"./toast-7fe0ecd0.js";import{c as O,I as U}from"./helpers-8c712f07.js";import{_ as L}from"./FormModal-4e061ea1.js";import{_ as g}from"./InputForm-99c9db6e.js";import{_ as m,a as T}from"./DropdownItem-bdaa2e83.js";import{I as z,a as F,b as S}from"./IconReportAnalytics-fd95b3cb.js";import{c as R}from"./IconUser-a321f0bf.js";import{I as D}from"./IconEdit-735d2da5.js";import{_ as G}from"./ClientareaLayout-0d24e6af.js";import"./IconList-de769f22.js";import"./use-resolve-button-type-7c0fe51a.js";var H=R("box","IconBox",[["path",{d:"M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5",key:"svg-0"}],["path",{d:"M12 12l8 -4.5",key:"svg-1"}],["path",{d:"M12 12l0 9",key:"svg-2"}],["path",{d:"M12 12l-8 -4.5",key:"svg-3"}]]);function J(){const r=B({id:"",name:"",email:" ",password:"",password_confirmation:""});function c(a=null){if(r.password!==r.password_confirmation){p.error("Las contraseñas no coinciden");return}r.post(route("clientarea.sellers.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Guardado correctamente"),a&&a()},onError:s=>{p.error(s.message)}})}function d(a=null){r.put(route("clientarea.sellers.update",r.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Actualizado correctamente"),a&&a()}})}function i(a=null){r.put(route("clientarea.toggle-status",r.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Actualizado correctamente"),a&&a()}})}function v(a){O({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{r.delete(route("clientarea.sellers.destroy",a),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Eliminado correctamente")}})}})}return{form:r,store:c,update:d,destroy:v,toggleStatus:i}}const K={class:"grid grid-cols-1 sm:grid-cols-3 gap-4"},P={class:"bg-card rounded-xl p-2 w-full"},Q={class:"flex gap-2 w-full"},W=l("div",{class:"bg-white rounded-xl w-1/3 px-1"},[l("img",{src:"/images/vendedor.png",alt:"",class:"w-20 h-20 object-contain"})],-1),X={class:"text-xs text-gray-600 w-full h-full"},Y={class:"flex justify-between w-full"},Z={class:""},ee={class:"px-1 py-1"},te={class:"px-1 py-1"},se={class:"flex flex-col"},re={class:"text-base"},oe={__name:"SellerTab",props:{sellers:{type:Object,required:!0},triggerNew:{type:Boolean,required:!0}},setup(r){const c=r,d=y(!1),i=y(!0),{store:v,update:a,form:s,toggleStatus:k,destroy:C}=J(),I=n=>{s.id=n,k()},N=()=>{i.value?v(h):a(h)},h=()=>{s.reset(),i.value=!0,d.value=!1},$=n=>{i.value=!1,s.id=n.id,s.name=n.name,s.email=n.email,d.value=!0};E(()=>c.triggerNew,n=>{i.value=!0,d.value=!0});const q={enabled:"Bloquear",disabled:"Desbloquear"};return(n,u)=>(f(),_(b,null,[l("div",K,[(f(!0),_(b,null,j(r.sellers,e=>(f(),_("div",P,[l("div",Q,[W,l("div",X,[l("div",Y,[l("span",Z,x(e.status=="enabled"?"Activo":"Inactivo"),1),o(T,null,{default:w(()=>[l("div",ee,[o(m,{href:n.route("clientarea.sellers.show",e.id),title:"Ventas",icon:t(z)},null,8,["href","icon"]),o(m,{href:n.route("clientarea.sellers.archings.index",e.id),title:"Caja",icon:t(H)},null,8,["href","icon"]),o(m,{href:n.route("clientarea.sellers.reports.index",e.id),title:"Reportes",icon:t(F)},null,8,["href","icon"])]),l("div",te,[o(m,{href:n.route("clientarea.sellers.blocked-numbers.index",e.id),title:"Dígitos bloqueados",icon:t(S)},null,8,["href","icon"]),o(m,{onClick:V=>$(e),title:"Editar",icon:t(D)},null,8,["onClick","icon"]),o(m,{onClick:V=>I(e.id),title:q[e.status],icon:t(S)},null,8,["onClick","title","icon"]),o(m,{onClick:V=>t(C)(e.id),title:"Eliminar",icon:t(U)},null,8,["onClick","icon"])])]),_:2},1024)]),l("div",se,[l("span",re,x(e.name),1),l("span",null,x(e.email),1)])])])]))),256))]),o(L,{show:d.value,title:"Vendedor",onOnCancel:h,onOnSubmit:N},{default:w(()=>[o(g,{text:"Nombre",modelValue:t(s).name,"onUpdate:modelValue":u[0]||(u[0]=e=>t(s).name=e),required:""},null,8,["modelValue"]),o(g,{text:"Correo",modelValue:t(s).email,"onUpdate:modelValue":u[1]||(u[1]=e=>t(s).email=e),type:"email",required:"",autocomple:"nope"},null,8,["modelValue"]),i.value?(f(),_(b,{key:0},[o(g,{text:"Contraseña",modelValue:t(s).password,"onUpdate:modelValue":u[2]||(u[2]=e=>t(s).password=e),type:"password",required:""},null,8,["modelValue"]),o(g,{text:"Confirmar contraseña",modelValue:t(s).password_confirmation,"onUpdate:modelValue":u[3]||(u[3]=e=>t(s).password_confirmation=e),type:"password",required:""},null,8,["modelValue"])],64)):A("",!0)]),_:1},8,["show"])],64))}},le=l("span",{class:"title"}," Vendedores ",-1),we={__name:"Index",props:{sellers:{type:Object,required:!0}},setup(r){const c=y(!1);return(d,i)=>(f(),M(G,{title:"Vendedores"},{header:w(()=>[le,l("button",{onClick:i[0]||(i[0]=v=>c.value=!c.value),type:"button",class:"simple-button"}," Nuevo ")]),default:w(()=>[o(oe,{sellers:r.sellers,triggerNew:c.value},null,8,["sellers","triggerNew"])]),_:1}))}};export{we as default};