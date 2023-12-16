import{_ as M}from"./AddButton-daf50cdd.js";import{a as I,_ as x}from"./Dropdown-9e0215ee.js";import{_ as V}from"./Checkbox-00c73fde.js";import{_ as u}from"./InputForm-96dfb5f3.js";import{_ as C}from"./FormModal-d63c5057.js";import{T as O,r as v,g as q,o as g,j as L,e as p,a as i,b as a,c as b,h as j,F as B,u as s,d as E,t as h}from"./app-f2c86ea5.js";import{t as d}from"./toast-518b0759.js";import{_ as F}from"./AppLayout-780b0984.js";import{c as T}from"./IconUser-83c130e4.js";import{I as z}from"./IconEdit-6fae3eba.js";import"./IconList-bc92a2cb.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./IconUsers-fb75f0bb.js";var G=T("copy","IconCopy",[["path",{d:"M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z",key:"svg-0"}],["path",{d:"M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2",key:"svg-1"}]]);function H(){const o=O({id:"",name:"",image:"",settings:{min:null,max:null,date:!1,super_x:!1,general_limit:null,individual_limit:null,multiplier:70}});function _(n=null){o.post(route("dashboard.raffles.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{d.success("Raffle created successfully"),n&&n()}})}function m(n=null){o.put(route("dashboard.raffles.update",o.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{d.success("Raffle updated successfully"),n&&n()}})}function c(n=null){o.put(route("dashboard.raffles.clone",o.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{d.success("Rifa clonada con éxito"),n&&n()}})}return{form:o,store:_,update:m,clone:c}}const X=a("span",{class:"title"}," Rifa ",-1),A={class:"grid grid-cols-1 lg:grid-cols-4 gap-4"},J={class:"bg-card rounded-xl p-2 w-full"},K={class:"flex justify-between"},P={class:"mb-2"},Q={class:"px-1 py-1"},W={class:"text-xs text-gray-600"},Y={class:"bg-white w-full p-3"},Z={class:"grid grid-cols-2 gap-4"},D={class:"grid grid-cols-2 gap-4 mb-1"},ee={key:0,class:"grid grid-cols-2 gap-4"},pe={__name:"Index",props:{raffles:{type:Object,required:!0}},setup(o){const _=[{name:"Home",route:route("dashboard.raffles.index")},{name:"Rifas",route:route("dashboard.raffles.index")}],m=v(!1),c=v(!1),n=v(!0),{store:y,update:k,form:e,clone:N}=H();function S(r){Object.assign(e,r),m.value=!0,n.value=!1}q(()=>e.settings.date,r=>{r&&(e.settings.min=null,e.settings.max=null)});function $(){if(isNaN(e.settings.min)){d.error("Min must be a number");return}if(isNaN(e.settings.max)){d.error("Max must be a number");return}if(isNaN(e.settings.general_limit)){d.error("General Limit must be a number");return}if(isNaN(e.settings.individual_limit)){d.error("Individual Limit must be a number");return}n.value?y(f):k(f)}const f=()=>{e.reset(),m.value=!1,c.value=!1,n.value=!0};function w(r){e.id=r.id,e.name=r.name+" (Copia)",c.value=!0}function U(){N(f)}return(r,l)=>(g(),L(F,{title:"Rifa",breads:_},{header:p(()=>[X,i(M,{onClick:l[0]||(l[0]=t=>m.value=!0)})]),default:p(()=>[a("div",A,[(g(!0),b(B,null,j(o.raffles,t=>(g(),b("div",J,[a("div",K,[a("span",P,h(t.name),1),i(I,null,{default:p(()=>[a("div",Q,[i(x,{onClick:R=>w(t),title:"Clonar",icon:s(G)},null,8,["onClick","icon"]),i(x,{onClick:R=>S(t),title:"Editar",icon:s(z)},null,8,["onClick","icon"])])]),_:2},1024)]),a("div",W,[a("pre",Y,h(t.settings),1)])]))),256))]),i(C,{show:m.value,title:"Rifa",onOnCancel:f,onOnSubmit:$},{default:p(()=>[i(u,{text:"Nombre",modelValue:s(e).name,"onUpdate:modelValue":l[1]||(l[1]=t=>s(e).name=t)},null,8,["modelValue"]),a("div",Z,[i(u,{text:"Limite general C$",modelValue:s(e).settings.general_limit,"onUpdate:modelValue":l[2]||(l[2]=t=>s(e).settings.general_limit=t),type:"number"},null,8,["modelValue"]),i(u,{text:"Limite indiv. C$",modelValue:s(e).settings.individual_limit,"onUpdate:modelValue":l[3]||(l[3]=t=>s(e).settings.individual_limit=t),type:"number"},null,8,["modelValue"])]),a("div",D,[i(V,{checked:s(e).settings.super_x,"onUpdate:checked":l[4]||(l[4]=t=>s(e).settings.super_x=t),text:"Super X"},null,8,["checked"]),i(V,{checked:s(e).settings.date,"onUpdate:checked":l[5]||(l[5]=t=>s(e).settings.date=t),text:"Fecha"},null,8,["checked"])]),s(e).settings.date?E("",!0):(g(),b("div",ee,[i(u,{text:"Número inicio",modelValue:s(e).settings.min,"onUpdate:modelValue":l[6]||(l[6]=t=>s(e).settings.min=t),required:"",type:"number"},null,8,["modelValue"]),i(u,{text:"Número final",modelValue:s(e).settings.max,"onUpdate:modelValue":l[7]||(l[7]=t=>s(e).settings.max=t),required:"",type:"number"},null,8,["modelValue"])])),i(u,{text:"Multiplicador",modelValue:s(e).settings.multiplier,"onUpdate:modelValue":l[8]||(l[8]=t=>s(e).settings.multiplier=t),type:"number",required:""},null,8,["modelValue"])]),_:1},8,["show"]),i(C,{show:c.value,title:"Clonar",onOnCancel:f,onOnSubmit:U},{default:p(()=>[i(u,{text:"Nuevo nombre",modelValue:s(e).name,"onUpdate:modelValue":l[9]||(l[9]=t=>s(e).name=t),required:""},null,8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{pe as default};
