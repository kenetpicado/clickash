import{_ as $,a as C}from"./DropdownItem-b59cd20f.js";import{_ as S}from"./InputForm-37918877.js";import{_ as V}from"./SelectForm-8c0056df.js";import{_ as w}from"./FormModal-7b0f5bbe.js";import{o as s,c as l,d as a,t as m,e as q,p as E,r as N,T as I,m as T,k as g,f as d,F as b,l as v,b as _,u as c}from"./app-c30d065f.js";import{_ as O}from"./ClientareaLayout-5f4f4b74.js";import{C as j}from"./Carbon-d935ed77.js";import{I as B,c as x}from"./helpers-aa058c0e.js";import{t as u}from"./toast-1dad5d10.js";import{c as F}from"./IconUser-29de581c.js";import"./IconList-18fe5c59.js";import"./use-resolve-button-type-2d2b00d8.js";import"./Modal-b6dcd1b9.js";var D=F("check","IconCheck",[["path",{d:"M5 12l5 5l10 -10",key:"svg-0"}]]);const G={class:"bg-card rounded-xl"},A={class:"flex h-full items-center justify-between p-4"},L={class:"text-gray-600 space-y-1"},M={class:"font-bold text-lg"},U={class:"text-sm"},H={key:0,class:"text-sm"},P={__name:"StatCardActions",props:{stat:{type:Object,required:!0}},setup(n){return(e,f)=>(s(),l("div",G,[a("div",A,[a("div",L,[a("div",M,m(n.stat.value),1),a("div",U,m(n.stat.title),1),n.stat.date?(s(),l("div",H,m(n.stat.date),1)):q("",!0)]),a("div",null,[E(e.$slots,"default")])])]))}},R={class:"title"},W={key:0,class:"w-full text-center text-gray-400 mb-4"},Y={key:1,class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},z={class:"px-1 py-1"},J={key:0,class:"text-red-500 mb-4"},K=a("option",{value:"",disabled:"",selected:""},"Seleccione un turno",-1),Q=["value"],X=a("div",{class:"text-gray-400 text-sm"}," Verifique que los datos ingresados sean correctos antes de guardar. ",-1),fe={__name:"WinningNumber",props:{winning_numbers:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(n){const e=n,f=N(!1),o=I({number:null,hour:null}),h=T(()=>e.winning_numbers.map(t=>({id:t.id,title:"Turno: "+t.hour,value:"Dígito: "+t.number,date:"Fecha: "+t.date,icon:D})));function p(){o.reset(),f.value=!1}const y=()=>{if(e.winning_numbers.find(t=>t.hour==o.hour)){u.error("Ya existe un resultado para este turno");return}if(e.raffle.settings.max){if(parseInt(o.number)>parseInt(e.raffle.settings.max)){u.error("El número ingresado supera el máximo permitido: "+e.raffle.settings.max);return}if(o.number.length>e.raffle.settings.max.length){u.error("Los números solo pueden contener "+e.raffle.settings.max.length+" digitos");return}}x({title:"Confirmar",message:"¿Esta seguro de agregar este resultado?",onConfirm:()=>{o.post(route("clientarea.raffles.winning-numbers.store",e.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p(),u.success("Guardado correctamente")},onError:t=>{u.error(t.message)}})}})};function k(t){x({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{o.delete(route("clientarea.raffles.winning-numbers.destroy",[e.raffle.id,t]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p(),u.success("Eliminado correctamente")},onError:i=>{u.error(i.message)}})}})}return(t,i)=>(s(),g(O,{title:"Ganadores"},{header:d(()=>[a("span",R,m(n.raffle.name)+": Ganadores ",1),a("button",{type:"button",class:"primary-button",onClick:i[0]||(i[0]=r=>f.value=!0)}," Nuevo ")]),default:d(()=>[h.value.length==0?(s(),l("div",W," No hay resultados ")):(s(),l("div",Y,[(s(!0),l(b,null,v(h.value,r=>(s(),g(P,{stat:r,key:r.title},{default:d(()=>[_(C,null,{default:d(()=>[a("div",z,[_($,{onClick:Z=>k(r.id),title:"Eliminar",icon:c(B)},null,8,["onClick","icon"])])]),_:2},1024)]),_:2},1032,["stat"]))),128))])),_(w,{show:f.value,title:"Resultado",onOnCancel:p,onOnSubmit:y},{default:d(()=>[n.raffle.blocked_hours.length==0?(s(),l("div",J,' No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en "Horario" ')):(s(),g(V,{key:1,modelValue:c(o).hour,"onUpdate:modelValue":i[1]||(i[1]=r=>c(o).hour=r),text:"Turno",required:""},{default:d(()=>[K,(s(!0),l(b,null,v(n.raffle.blocked_hours,r=>(s(),l("option",{value:r},m(c(j).create().setTime(r).getTimeFormat()),9,Q))),256))]),_:1},8,["modelValue"])),_(S,{modelValue:c(o).number,"onUpdate:modelValue":i[2]||(i[2]=r=>c(o).number=r),text:"Dígito",required:""},null,8,["modelValue"]),X]),_:1},8,["show"])]),_:1}))}};export{fe as default};
