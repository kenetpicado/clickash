import{_ as m}from"./InputForm-b3d4eebc.js";import{_ as V}from"./FormModal-2c969207.js";import{_ as S}from"./ClientareaLayout-cae29f17.js";import{c as x}from"./helpers-ee1dd732.js";import{t as b}from"./toast-a35b6174.js";import{T as B,r as _,o as l,k as v,f as d,d as c,t as q,c as f,F as O,l as $,b as o,u as s,O as N}from"./app-b9c931a0.js";import{_ as w,a as C}from"./Error-f08c7427.js";import"./Modal-36832df0.js";import"./DropdownItem-b62aa329.js";import"./createVueComponent-5a0326f8.js";import"./useAuth-6ae4d293.js";import"./IconUser-5bef4d49.js";import"./IconTrash-8e83b230.js";const E={class:"title"},h={key:0,class:"w-full text-center text-gray-400"},D={key:1,class:"grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4"},L={class:"grid grid-cols-2 gap-2"},Q={__name:"BlockedNumber",props:{blockeds:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(a){const g=a,t=B({number:null,settings:{general_limit:null,individual_limit:null}}),n=_(!1),u=_(null),y=()=>{t.post(route("clientarea.raffles.blocked-numbers.store",g.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p(),b.success("Agregado correctamente")},onError:i=>{u.value=i.message}})},p=()=>{t.reset(),u.value=null,n.value=!1},k=i=>{x({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{N.delete(route("clientarea.raffles.blocked-numbers.destroy",[g.raffle.id,i]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b.success("Eliminado correctamente")}})}})};return(i,r)=>(l(),v(S,{title:"Bloqueados"},{header:d(()=>[c("span",E,q(a.raffle.name)+": Bloqueados ",1),c("button",{type:"button",class:"primary-button",onClick:r[0]||(r[0]=e=>n.value=!0)}," Nuevo ")]),default:d(()=>[a.blockeds.length==0?(l(),f("div",h," No hay dígitos bloqueados 😥️ ")):(l(),f("div",D,[(l(!0),f(O,null,$(a.blockeds,e=>(l(),v(w,{digit:e,key:e.id,onDestroy:k},null,8,["digit"]))),128))])),o(V,{show:n.value,title:"Bloquear",onOnCancel:p,onOnSubmit:y},{default:d(()=>[o(m,{text:"Dígito",modelValue:s(t).number,"onUpdate:modelValue":r[1]||(r[1]=e=>s(t).number=e),required:""},null,8,["modelValue"]),c("div",L,[o(m,{text:"Limite individual",modelValue:s(t).settings.individual_limit,"onUpdate:modelValue":r[2]||(r[2]=e=>s(t).settings.individual_limit=e),type:"number"},null,8,["modelValue"]),o(m,{text:"Limite general",modelValue:s(t).settings.general_limit,"onUpdate:modelValue":r[3]||(r[3]=e=>s(t).settings.general_limit=e),type:"number"},null,8,["modelValue"])]),o(C,{message:u.value},null,8,["message"])]),_:1},8,["show"])]),_:1}))}};export{Q as default};
