import{_ as I}from"./AddButton-177a888f.js";import{_ as x,a as O}from"./DropdownItem-84b3e997.js";import{_ as b}from"./Checkbox-aaf3beaf.js";import{_ as a}from"./InputForm-e16abf03.js";import{_ as C}from"./FormModal-b27e4063.js";import{T as q,l as _,h as M,o as g,j as k,e as m,a as n,b as c,c as V,k as B,u as l,F as j,d as y}from"./app-3bfb5daa.js";import{t as u}from"./toast-002aa171.js";import{_ as F}from"./AppLayout-5ddb7563.js";import{_ as L}from"./JsonContent-a20cecc7.js";import{c as T}from"./IconUser-8d980923.js";import{I as z}from"./IconEdit-8f225f4e.js";import"./IconList-caffa855.js";import"./use-resolve-button-type-37e33f60.js";import"./IconUsers-7a84134d.js";var X=T("copy","IconCopy",[["path",{d:"M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z",key:"svg-0"}],["path",{d:"M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2",key:"svg-1"}]]);function A(){const o=q({id:"",name:"",image:"",settings:{min:null,max:null,date:!1,super_x:!1,general_limit:null,individual_limit:null,multiplier:70}});function v(i=null){o.post(route("dashboard.raffles.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Raffle created successfully"),i&&i()}})}function d(i=null){o.put(route("dashboard.raffles.update",o.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Raffle updated successfully"),i&&i()}})}function f(i=null){o.put(route("dashboard.raffles.clone",o.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Rifa clonada con éxito"),i&&i()}})}return{form:o,store:v,update:d,clone:f}}const G=c("span",{class:"title"}," Rifa ",-1),H={class:"grid grid-cols-1 lg:grid-cols-4 gap-4"},J={class:"px-1 py-1"},K={key:0,class:"w-40 h-40 overflow-hidden mb-6"},P=["src"],Q={class:"grid grid-cols-2 gap-4"},W={class:"grid grid-cols-2 gap-4 mb-1"},Y={key:1,class:"grid grid-cols-2 gap-4"},ce={__name:"Index",props:{raffles:{type:Object,required:!0}},setup(o){const v=[{name:"Inicio",route:route("dashboard.index")},{name:"Rifas",route:window.location.href}],d=_(!1),f=_(!1),i=_(!0),{store:h,update:N,form:e,clone:S}=A();function $(r){Object.assign(e,r),d.value=!0,i.value=!1}M(()=>e.settings.date,r=>{r&&(e.settings.min=null,e.settings.max=null)});function w(){if(isNaN(e.settings.min)){u.error("El mínimo debe ser un número");return}if(isNaN(e.settings.max)){u.error("El máximo debe ser un número");return}if(isNaN(e.settings.general_limit)){u.error("El límite general debe ser un número");return}if(isNaN(e.settings.individual_limit)){u.error("El límite individual debe ser un número");return}i.value?h(p):N(p)}const p=()=>{e.reset(),d.value=!1,f.value=!1,i.value=!0};function U(r){e.id=r.id,e.name=r.name+" (Copia)",f.value=!0}function R(){S(p)}return(r,s)=>(g(),k(F,{title:"Rifa",breads:v},{header:m(()=>[G,n(I,{onClick:s[0]||(s[0]=t=>d.value=!0)})]),default:m(()=>[c("div",H,[(g(!0),V(j,null,B(o.raffles,t=>(g(),k(L,{title:t.name,content:t.settings},{default:m(()=>[n(O,null,{default:m(()=>[c("div",J,[n(x,{onClick:E=>U(t),title:"Clonar",icon:l(X)},null,8,["onClick","icon"]),n(x,{onClick:E=>$(t),title:"Editar",icon:l(z)},null,8,["onClick","icon"])])]),_:2},1024)]),_:2},1032,["title","content"]))),256))]),n(C,{show:d.value,title:"Rifa",onOnCancel:p,onOnSubmit:w},{default:m(()=>[n(a,{text:"Nombre",modelValue:l(e).name,"onUpdate:modelValue":s[1]||(s[1]=t=>l(e).name=t)},null,8,["modelValue"]),n(a,{text:"Imagen",modelValue:l(e).image,"onUpdate:modelValue":s[2]||(s[2]=t=>l(e).image=t),type:"url"},null,8,["modelValue"]),l(e).image?(g(),V("div",K,[c("img",{src:l(e).image,alt:"",class:"w-full h-full"},null,8,P)])):y("",!0),c("div",Q,[n(a,{text:"Limite general C$",modelValue:l(e).settings.general_limit,"onUpdate:modelValue":s[3]||(s[3]=t=>l(e).settings.general_limit=t),type:"number"},null,8,["modelValue"]),n(a,{text:"Limite indiv. C$",modelValue:l(e).settings.individual_limit,"onUpdate:modelValue":s[4]||(s[4]=t=>l(e).settings.individual_limit=t),type:"number"},null,8,["modelValue"])]),c("div",W,[n(b,{checked:l(e).settings.super_x,"onUpdate:checked":s[5]||(s[5]=t=>l(e).settings.super_x=t),text:"Super X"},null,8,["checked"]),n(b,{checked:l(e).settings.date,"onUpdate:checked":s[6]||(s[6]=t=>l(e).settings.date=t),text:"Fecha"},null,8,["checked"])]),l(e).settings.date?y("",!0):(g(),V("div",Y,[n(a,{text:"Número inicio",modelValue:l(e).settings.min,"onUpdate:modelValue":s[7]||(s[7]=t=>l(e).settings.min=t),required:"",type:"number"},null,8,["modelValue"]),n(a,{text:"Número final",modelValue:l(e).settings.max,"onUpdate:modelValue":s[8]||(s[8]=t=>l(e).settings.max=t),required:"",type:"number"},null,8,["modelValue"])])),n(a,{text:"Multiplicador",modelValue:l(e).settings.multiplier,"onUpdate:modelValue":s[9]||(s[9]=t=>l(e).settings.multiplier=t),type:"number",required:""},null,8,["modelValue"])]),_:1},8,["show"]),n(C,{show:f.value,title:"Clonar",onOnCancel:p,onOnSubmit:R},{default:m(()=>[n(a,{text:"Nuevo nombre",modelValue:l(e).name,"onUpdate:modelValue":s[10]||(s[10]=t=>l(e).name=t),required:""},null,8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{ce as default};
