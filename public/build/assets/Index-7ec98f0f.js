import{T as B,l as y,j as E,o as f,c as _,b as a,F as b,k as j,t as x,a as o,e as w,u as t,d as A,g as M}from"./app-be0400f8.js";import{t as p}from"./toast-58cfedeb.js";import{c as O,I as U}from"./helpers-85b5af26.js";import{_ as L}from"./FormModal-5bb182d9.js";import{_ as g}from"./InputForm-d9bf4b6c.js";import{_ as m,a as T}from"./Dropdown-49308a3a.js";import{I as z,a as F,b as S}from"./IconReportAnalytics-ec57871b.js";import{c as R}from"./IconUser-2621c65e.js";import{I as G}from"./IconEdit-e85f85eb.js";import{_ as H}from"./ClientareaLayout-8203113d.js";import"./use-resolve-button-type-17e1e748.js";import"./IconList-69444146.js";var J=R("box","IconBox",[["path",{d:"M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5",key:"svg-0"}],["path",{d:"M12 12l8 -4.5",key:"svg-1"}],["path",{d:"M12 12l0 9",key:"svg-2"}],["path",{d:"M12 12l-8 -4.5",key:"svg-3"}]]);function K(){const r=B({id:"",name:"",email:" ",password:"",password_confirmation:""});function c(l=null){if(r.password!==r.password_confirmation){p.error("Las contraseñas no coinciden");return}r.post(route("clientarea.sellers.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Guardado correctamente"),l&&l()},onError:s=>{p.error(s.message),l&&l()}})}function d(l=null){r.put(route("clientarea.sellers.update",r.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Actualizado correctamente"),l&&l()}})}function i(l=null){r.put(route("clientarea.toggle-status",r.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Actualizado correctamente"),l&&l()}})}function v(l){O({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{r.delete(route("clientarea.sellers.destroy",l),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Eliminado correctamente")}})}})}return{form:r,store:c,update:d,destroy:v,toggleStatus:i}}const P={class:"grid grid-cols-1 sm:grid-cols-3 gap-4"},Q={class:"bg-card rounded-xl p-2 w-full"},W={class:"flex gap-2 w-full"},X=a("div",{class:"bg-white rounded-xl w-1/3 px-1"},[a("img",{src:"/images/vendedor.png",alt:"",class:"w-20 h-20 object-contain"})],-1),Y={class:"text-xs text-gray-600 w-full h-full"},Z={class:"flex justify-between w-full"},D={class:""},ee={class:"px-1 py-1"},te={class:"px-1 py-1"},se={class:"flex flex-col"},re={class:"text-base"},le={__name:"SellerTab",props:{sellers:{type:Object,required:!0},triggerNew:{type:Boolean,required:!0}},setup(r){const c=r,d=y(!1),i=y(!0),{store:v,update:l,form:s,toggleStatus:k,destroy:C}=K(),I=n=>{s.id=n,k()},N=()=>{i.value?v(h):l(h)},h=()=>{s.reset(),i.value=!0,d.value=!1},$=n=>{i.value=!1,s.id=n.id,s.name=n.name,s.email=n.email,d.value=!0};E(()=>c.triggerNew,n=>{i.value=!0,d.value=!0});const q={enabled:"Bloquear",disabled:"Desbloquear"};return(n,u)=>(f(),_(b,null,[a("div",P,[(f(!0),_(b,null,j(r.sellers,e=>(f(),_("div",Q,[a("div",W,[X,a("div",Y,[a("div",Z,[a("span",D,x(e.status=="enabled"?"Activo":"Inactivo"),1),o(T,null,{default:w(()=>[a("div",ee,[o(m,{href:n.route("clientarea.sellers.show",e.id),title:"Ventas",icon:t(z)},null,8,["href","icon"]),o(m,{href:n.route("clientarea.sellers.archings.index",e.id),title:"Caja",icon:t(J)},null,8,["href","icon"]),o(m,{href:n.route("clientarea.sellers.reports.index",e.id),title:"Reportes",icon:t(F)},null,8,["href","icon"])]),a("div",te,[o(m,{href:n.route("clientarea.sellers.blocked-numbers.index",e.id),title:"Dígitos bloqueados",icon:t(S)},null,8,["href","icon"]),o(m,{onClick:V=>$(e),title:"Editar",icon:t(G)},null,8,["onClick","icon"]),o(m,{onClick:V=>I(e.id),title:q[e.status],icon:t(S)},null,8,["onClick","title","icon"]),o(m,{onClick:V=>t(C)(e.id),title:"Eliminar",icon:t(U)},null,8,["onClick","icon"])])]),_:2},1024)]),a("div",se,[a("span",re,x(e.name),1),a("span",null,x(e.email),1)])])])]))),256))]),o(L,{show:d.value,title:"Vendedor",onOnCancel:h,onOnSubmit:N},{default:w(()=>[o(g,{text:"Nombre",modelValue:t(s).name,"onUpdate:modelValue":u[0]||(u[0]=e=>t(s).name=e),required:""},null,8,["modelValue"]),o(g,{text:"Correo",modelValue:t(s).email,"onUpdate:modelValue":u[1]||(u[1]=e=>t(s).email=e),type:"email",required:"",autocomple:"nope"},null,8,["modelValue"]),i.value?(f(),_(b,{key:0},[o(g,{text:"Contraseña",modelValue:t(s).password,"onUpdate:modelValue":u[2]||(u[2]=e=>t(s).password=e),type:"password",required:""},null,8,["modelValue"]),o(g,{text:"Confirmar contraseña",modelValue:t(s).password_confirmation,"onUpdate:modelValue":u[3]||(u[3]=e=>t(s).password_confirmation=e),type:"password",required:""},null,8,["modelValue"])],64)):A("",!0)]),_:1},8,["show"])],64))}},oe=a("span",{class:"title"}," Vendedores ",-1),we={__name:"Index",props:{sellers:{type:Object,required:!0}},setup(r){const c=y(!1);return(d,i)=>(f(),M(H,{title:"Vendedores"},{header:w(()=>[oe,a("button",{onClick:i[0]||(i[0]=v=>c.value=!c.value),type:"button",class:"simple-button"}," Nuevo ")]),default:w(()=>[o(le,{sellers:r.sellers,triggerNew:c.value},null,8,["sellers","triggerNew"])]),_:1}))}};export{we as default};