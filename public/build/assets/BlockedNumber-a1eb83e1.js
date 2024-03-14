import{_ as m}from"./InputForm-81d54900.js";import{_ as V}from"./FormModal-60733c17.js";import{_ as S}from"./ClientareaLayout-60ab41ff.js";import{c as x}from"./helpers-f5c53c74.js";import{t as b}from"./toast-9b4598a6.js";import{T as B,r as _,o as r,k as v,f as d,d as c,t as q,c as f,F as O,l as $,b as o,u as l,O as N}from"./app-7036221c.js";import{_ as w,a as C}from"./Error-f6ff6e55.js";import"./Modal-c272fae5.js";import"./DropdownItem-236e3c27.js";import"./IconUser-057cecd7.js";const E={class:"title"},h={key:0,class:"w-full text-center text-gray-400"},D={key:1,class:"grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4"},L={class:"grid grid-cols-2 gap-2"},J={__name:"BlockedNumber",props:{blockeds:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(a){const g=a,t=B({number:null,settings:{general_limit:null,individual_limit:null}}),n=_(!1),u=_(null),y=()=>{t.post(route("clientarea.raffles.blocked-numbers.store",g.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p(),b.success("Agregado correctamente")},onError:i=>{u.value=i.message}})},p=()=>{t.reset(),u.value=null,n.value=!1},k=i=>{x({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{N.delete(route("clientarea.raffles.blocked-numbers.destroy",[g.raffle.id,i]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b.success("Eliminado correctamente")}})}})};return(i,s)=>(r(),v(S,{title:"Bloqueados"},{header:d(()=>[c("span",E,q(a.raffle.name)+": Bloqueados ",1),c("button",{type:"button",class:"primary-button",onClick:s[0]||(s[0]=e=>n.value=!0)}," Nuevo ")]),default:d(()=>[a.blockeds.length==0?(r(),f("div",h," No hay dígitos bloqueados 😥️ ")):(r(),f("div",D,[(r(!0),f(O,null,$(a.blockeds,e=>(r(),v(w,{digit:e,key:e.id,onDestroy:k},null,8,["digit"]))),128))])),o(V,{show:n.value,title:"Bloquear",onOnCancel:p,onOnSubmit:y},{default:d(()=>[o(m,{text:"Dígito",modelValue:l(t).number,"onUpdate:modelValue":s[1]||(s[1]=e=>l(t).number=e),required:""},null,8,["modelValue"]),c("div",L,[o(m,{text:"Limite individual",modelValue:l(t).settings.individual_limit,"onUpdate:modelValue":s[2]||(s[2]=e=>l(t).settings.individual_limit=e),type:"number"},null,8,["modelValue"]),o(m,{text:"Limite general",modelValue:l(t).settings.general_limit,"onUpdate:modelValue":s[3]||(s[3]=e=>l(t).settings.general_limit=e),type:"number"},null,8,["modelValue"])]),o(C,{message:u.value},null,8,["message"])]),_:1},8,["show"])]),_:1}))}};export{J as default};
