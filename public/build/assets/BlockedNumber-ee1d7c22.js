import{_ as c}from"./InputForm-9c83281e.js";import{_ as y}from"./FormModal-2ee5cb69.js";import{T as k}from"./TableSection-cddd6cd9.js";import{I as v,c as V}from"./helpers-216f0a78.js";import{t as u}from"./toast-222764f6.js";import{T as N,o as l,c as i,a as r,f as _,F as S,h as C,d as q,u as n,b as o,t as p,O as x}from"./app-4678c2f9.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./createVueComponent-c8464d70.js";const B=o("th",null,"Numero",-1),O=o("th",null,"Limite individual",-1),E=o("th",null,"Limite general",-1),L=o("th",null,"Acciones",-1),$={class:"font-semibold"},M={key:0,class:"badge-red"},T={key:1},w={key:0,class:"badge-red"},U={key:1},j=["onClick"],A={key:0},D=o("td",{colspan:"4",class:"text-center"},"No hay datos",-1),F=[D],I={class:"grid grid-cols-2 gap-2"},X={__name:"BlockedNumber",props:{raffle:{type:Object,required:!0},blockeds:{type:Object,required:!0},openModal:{type:Boolean,required:!0}},emits:["update:openModal"],setup(a,{emit:f}){const m=a,t=N({number:null,settings:{general_limit:null,individual_limit:null}}),b=()=>{if(!t.settings.general_limit&&!t.settings.individual_limit){u.error("Debe ingresar al menos un limite");return}if(m.blockeds.find(d=>d.number==t.number)){u.error("Numero ya bloqueado");return}t.post(route("clientarea.raffles.blocked-numbers.store",m.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{g(),u.success("Numero bloqueado")}})},g=()=>{t.reset(),f("update:openModal",!1)},h=d=>{V({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{x.delete(route("clientarea.raffles.blocked-numbers.destroy",[m.raffle.id,d]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Eliminado correctamente")},onError:s=>{console.log(s)}})}})};return(d,s)=>(l(),i("div",null,[r(k,null,{header:_(()=>[B,O,E,L]),body:_(()=>[(l(!0),i(S,null,C(a.blockeds,e=>(l(),i("tr",null,[o("td",$,p(e.number),1),o("td",null,[e.settings.individual_limit?(l(),i("span",M," C$"+p(e.settings.individual_limit),1)):(l(),i("span",T," Ninguno "))]),o("td",null,[e.settings.general_limit?(l(),i("span",w," C$"+p(e.settings.general_limit),1)):(l(),i("span",U," Ninguno "))]),o("td",null,[o("span",{tooltip:"Eliminar",role:"button",onClick:z=>h(e.id)},[r(n(v),{size:"22"})],8,j)])]))),256)),a.blockeds.length==0?(l(),i("tr",A,F)):q("",!0)]),_:1}),r(y,{show:a.openModal,title:"Bloquear",onOnCancel:g,onOnSubmit:b},{default:_(()=>[r(c,{text:"Numero",modelValue:n(t).number,"onUpdate:modelValue":s[0]||(s[0]=e=>n(t).number=e),type:"number",required:""},null,8,["modelValue"]),o("div",I,[r(c,{text:"Limite individual",modelValue:n(t).settings.individual_limit,"onUpdate:modelValue":s[1]||(s[1]=e=>n(t).settings.individual_limit=e),type:"number"},null,8,["modelValue"]),r(c,{text:"Limite general",modelValue:n(t).settings.general_limit,"onUpdate:modelValue":s[2]||(s[2]=e=>n(t).settings.general_limit=e),type:"number"},null,8,["modelValue"])])]),_:1},8,["show"])]))}};export{X as default};
