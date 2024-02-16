import{_ as c}from"./InputForm-b6e3bbf8.js";import{_ as y}from"./FormModal-bc7d11da.js";import{_ as k}from"./ClientareaLayout-9eea4ba9.js";import{c as V}from"./helpers-23c84eb7.js";import{t as n}from"./toast-724cb485.js";import{T as q,l as x,o,g as b,e as f,b as s,t as S,c as g,F as B,k as N,a as u,u as l,O}from"./app-cddf73c5.js";import{_ as h}from"./BlockedNumber-a8b629c1.js";import"./IconUser-398f2c6f.js";import"./_plugin-vue_export-helper-c27b6911.js";const D={class:"title"},$={key:0,class:"w-full text-center text-gray-400"},w={key:1,class:"grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4"},C={class:"grid grid-cols-2 gap-2"},E=s("p",{class:"text-primary"},[s("small",null," Nota: Recuerde ingresar el dígito con los ceros necesarios según la numeración de la rifa, por ejemplo, 01, 001, etc. De lo contrario, el bloqueo no se realizará correctamente. En cuanto a las fechas, utilice el formato dd/mm. ")],-1),G={__name:"BlockedNumber",props:{blockeds:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(a){const m=a,e=q({number:null,settings:{general_limit:null,individual_limit:null}}),d=x(!1),_=()=>{if(!e.settings.general_limit&&!e.settings.individual_limit){n.error("Debe ingresar al menos un limite");return}if(m.blockeds.find(i=>i.number==e.number)){n.error("Numero ya bloqueado");return}e.post(route("clientarea.raffles.blocked-numbers.store",m.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p(),n.success("Agregado correctamente")}})},p=()=>{e.reset(),d.value=!1},v=i=>{V({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{O.delete(route("clientarea.raffles.blocked-numbers.destroy",[m.raffle.id,i]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{n.success("Eliminado correctamente")}})}})};return(i,r)=>(o(),b(k,{title:"Bloqueados"},{header:f(()=>[s("span",D,S(a.raffle.name)+": Bloqueados ",1),s("button",{type:"button",class:"simple-button",onClick:r[0]||(r[0]=t=>d.value=!0)}," Nuevo ")]),default:f(()=>[a.blockeds.length==0?(o(),g("div",$," No hay dígitos bloqueados 😥️ ")):(o(),g("div",w,[(o(!0),g(B,null,N(a.blockeds,t=>(o(),b(h,{digit:t,key:t.id,onDestroy:v},null,8,["digit"]))),128))])),u(y,{show:d.value,title:"Bloquear",onOnCancel:p,onOnSubmit:_},{default:f(()=>[u(c,{text:"Dígito",modelValue:l(e).number,"onUpdate:modelValue":r[1]||(r[1]=t=>l(e).number=t),type:"number",required:""},null,8,["modelValue"]),s("div",C,[u(c,{text:"Limite individual",modelValue:l(e).settings.individual_limit,"onUpdate:modelValue":r[2]||(r[2]=t=>l(e).settings.individual_limit=t),type:"number"},null,8,["modelValue"]),u(c,{text:"Limite general",modelValue:l(e).settings.general_limit,"onUpdate:modelValue":r[3]||(r[3]=t=>l(e).settings.general_limit=t),type:"number"},null,8,["modelValue"])]),E]),_:1},8,["show"])]),_:1}))}};export{G as default};
