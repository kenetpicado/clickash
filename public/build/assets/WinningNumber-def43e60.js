import{T as v}from"./TableSection-cddd6cd9.js";import{T as x,j as V,o,c as r,a as i,f as c,F as f,h as b,d as k,b as e,u as n,t as m}from"./app-4678c2f9.js";import{_ as S}from"./FormModal-2ee5cb69.js";import{_ as N}from"./InputForm-9c83281e.js";import{_ as B}from"./SelectForm-96aa9d9e.js";import{C as T}from"./Carbon-e7b34390.js";import{t as p}from"./toast-222764f6.js";import"./_plugin-vue_export-helper-c27b6911.js";const q=e("th",null,"Fecha",-1),w=e("th",null,"Turno",-1),C=e("th",null,"Numero",-1),H=e("td",null," Hoy ",-1),O={class:"badge-blue whitespace-nowrap"},j={class:"text-sm badge-green"},F={key:0},M=e("td",{colspan:"3",class:"text-center"},"No hay datos",-1),$=[M],E={class:"grid grid-cols-2 gap-2"},U=e("option",{value:"",disabled:"",selected:""},"Seleccione un turno",-1),D=["value"],G={key:0,class:"text-red-500 mb-4"},L={key:1,class:"text-gray-400"},K={__name:"WinningNumber",props:{results:{type:Object,required:!0},raffle:{type:Object,required:!0},openModal:{type:Boolean,required:!0},currentBlockedHours:{type:Object,required:!0}},emits:["update:openModal"],setup(a,{emit:g}){const u=a,s=x({number:null,hour:null}),_=V(()=>u.currentBlockedHours.length==0?[]:u.currentBlockedHours[0].blocked_hours),h=()=>{s.reset(),g("update:openModal",!1)},y=()=>{if(u.results.find(l=>l.hour==s.hour)){p.error("Ya existe un resultado para este turno");return}s.post(route("clientarea.raffles.winning-numbers.store",u.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),p.success("Guardado correctamente")},onError:l=>{p.error(l.message)}})};return(l,d)=>(o(),r("div",null,[i(v,null,{header:c(()=>[q,w,C]),body:c(()=>[(o(!0),r(f,null,b(a.results,t=>(o(),r("tr",null,[H,e("td",null,[e("span",O,m(t.hour),1)]),e("td",null,[e("span",j,m(t.number),1)])]))),256)),a.results.length==0?(o(),r("tr",F,$)):k("",!0)]),_:1}),i(S,{show:a.openModal,title:"Resultado",onOnCancel:h,onOnSubmit:y},{default:c(()=>[e("div",E,[i(B,{modelValue:n(s).hour,"onUpdate:modelValue":d[0]||(d[0]=t=>n(s).hour=t),text:"Turno",required:""},{default:c(()=>[U,(o(!0),r(f,null,b(_.value,t=>(o(),r("option",{value:t},m(n(T).create().setTime(t).getTimeFormat()),9,D))),256))]),_:1},8,["modelValue"]),i(N,{modelValue:n(s).number,"onUpdate:modelValue":d[1]||(d[1]=t=>n(s).number=t),type:"number",text:"Numero"},null,8,["modelValue"])]),_.value.length==0?(o(),r("p",G,' No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en "Horario" ')):(o(),r("p",L," Solo puede agregar resultados del dia de hoy y 1 por turno. "))]),_:1},8,["show"])]))}};export{K as default};