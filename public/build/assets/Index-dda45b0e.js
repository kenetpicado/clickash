import{_ as w}from"./BlockedNumber-770205a3.js";import{_}from"./InputForm-7d6766da.js";import{_ as O}from"./SelectForm-7aecc34b.js";import{_ as B}from"./FormModal-675b8ad6.js";import{_ as D}from"./ClientareaLayout-56b8d184.js";import{c as N}from"./helpers-27df9234.js";import{t as c}from"./toast-648f1ae8.js";import{T as $,h as C,m as U,k as j,o as s,g as v,e as f,b as d,t as y,c as o,d as E,a as u,l as k,F as V,u as n,O as x}from"./app-e7b8d848.js";import"./IconUser-26e3f79d.js";import"./_plugin-vue_export-helper-c27b6911.js";const L={class:"title"},P={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},R=d("option",{value:"",selected:""},"Seleccione una rifa",-1),A=["value"],F={key:0,class:"w-full text-center text-gray-400"},z={key:1,class:"w-full text-center text-gray-400"},I={key:2,class:"grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4"},M={class:"grid grid-cols-2 gap-2"},T=d("p",{class:"text-primary"},[d("small",null," Nota: Recuerde ingresar el dígito con los ceros necesarios según la numeración de la rifa, por ejemplo, 01, 001, etc. De lo contrario, el bloqueo no se realizará correctamente. En cuanto a las fechas, utilice el formato dd/mm. ")],-1),te={__name:"Index",props:{blockeds:{type:Object,required:!0},seller:{type:Object,required:!0},raffles:{type:Object,required:!0}},setup(i){const m=i,r=$({number:null,raffle_id:null,settings:{general_limit:null,individual_limit:null}}),g=C(!1),h=new URLSearchParams(window.location.search),a=U({raffle_id:h.get("raffle_id")||null}),S=()=>{if(!r.settings.general_limit&&!r.settings.individual_limit){c.error("Debe ingresar al menos un limite");return}if(m.blockeds.find(l=>l.number==r.number)){c.error("Digito ya bloqueado");return}r.raffle_id=a.raffle_id,r.post(route("clientarea.sellers.blocked-numbers.store",m.seller.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b(),c.success("Agregado correctamente")}})},b=()=>{r.reset(),g.value=!1};j(()=>a,()=>{let l={...a};for(const t in l)l[t]||delete l[t];x.get(route("clientarea.sellers.blocked-numbers.index",m.seller.id),l,{preserveState:!0,only:["blockeds"],replace:!0})},{deep:!0});const q=l=>{N({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{x.delete(route("clientarea.sellers.blocked-numbers.destroy",[m.seller.id,l]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{c.success("Eliminado correctamente")}})}})};return(l,t)=>(s(),v(D,{title:"Bloqueados"},{header:f(()=>[d("span",L,y(i.seller.name)+": Bloqueados ",1),a.raffle_id?(s(),o("button",{key:0,type:"button",class:"simple-button",onClick:t[0]||(t[0]=p=>g.value=!0)}," Nuevo ")):E("",!0)]),default:f(()=>{var p;return[d("div",P,[u(O,{modelValue:a.raffle_id,"onUpdate:modelValue":t[1]||(t[1]=e=>a.raffle_id=e),text:"Rifa",required:""},{default:f(()=>[R,(s(!0),o(V,null,k(i.raffles,e=>(s(),o("option",{value:e.id},y(e.name),9,A))),256))]),_:1},8,["modelValue"])]),a.raffle_id?i.blockeds.length==0?(s(),o("div",z," No hay dígitos bloqueados 😥️ ")):(s(),o("div",I,[(s(!0),o(V,null,k(i.blockeds,e=>(s(),v(w,{digit:e,key:e.id,onDestroy:q},null,8,["digit"]))),128))])):(s(),o("div",F," Por favor seleccione una rifa ")),u(B,{show:g.value,title:(p=i.raffles.find(e=>a.raffle_id==e.id))==null?void 0:p.name,onOnCancel:b,onOnSubmit:S},{default:f(()=>[u(_,{text:"Dígito",modelValue:n(r).number,"onUpdate:modelValue":t[2]||(t[2]=e=>n(r).number=e),type:"number",required:""},null,8,["modelValue"]),d("div",M,[u(_,{text:"Limite individual",modelValue:n(r).settings.individual_limit,"onUpdate:modelValue":t[3]||(t[3]=e=>n(r).settings.individual_limit=e),type:"number"},null,8,["modelValue"]),u(_,{text:"Limite general",modelValue:n(r).settings.general_limit,"onUpdate:modelValue":t[4]||(t[4]=e=>n(r).settings.general_limit=e),type:"number"},null,8,["modelValue"])]),T]),_:1},8,["show","title"])]}),_:1}))}};export{te as default};
