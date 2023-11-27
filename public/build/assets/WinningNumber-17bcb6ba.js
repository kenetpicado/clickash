import{_ as w}from"./StatCard-30d401e3.js";import{_ as C}from"./Transaction-1929265d.js";import{_ as T}from"./ClientareaLayout-81d1ef90.js";import{C as d}from"./Carbon-e7b34390.js";import{_ as N}from"./FormModal-7a2f20d4.js";import{_ as O}from"./SelectForm-fdff178d.js";import{_ as v}from"./InputForm-4afd10fc.js";import{r as y,T as S,l as $,e as j,o as t,k as l,g as c,b as u,c as n,f as b,F as _,a as F,u as a,j as k,t as m,d as B}from"./app-a70b3f65.js";import{t as V}from"./toast-bb34ea8c.js";import{c as D}from"./helpers-bded64ce.js";import{c as G}from"./createVueComponent-ef26742a.js";import"./_plugin-vue_export-helper-c27b6911.js";var U=G("check","IconCheck",[["path",{d:"M5 12l5 5l10 -10",key:"svg-0"}]]);const A=u("span",{class:"title"}," Ganadores ",-1),E={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},I={key:0,class:"w-full text-center text-gray-400"},M={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},Y={key:0,class:"text-red-500 mb-4"},z=u("option",{value:"",disabled:"",selected:""},"Seleccione un turno",-1),H=["value"],L=u("div",{class:"text-gray-400 text-sm"}," Verifique que los datos ingresados sean correctos antes de guardar, ya que para garantizar la integridad de los datos no se permite eliminar ni editar los resultados. ",-1),P={key:4,class:"mt-5 text-basic"},R={class:"font-bold"},ne={__name:"WinningNumber",props:{winning_numbers:{type:Object,required:!0},winners:{type:Object,required:!0},hours:{type:Object,required:!0},settings:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(i){const f=i,p=y(!1),g=y(""),r=S({number:null,hour:null}),x=$(()=>f.winning_numbers.map(o=>({title:"Turno: "+d.create().setTime(o.hour).getTimeFormat(),value:"Dígito: "+o.number,icon:U})));function h(){r.reset(),p.value=!1}j(()=>g.value,o=>{o?r.number=d.create(o).format("d/m"):r.number=null});const q=()=>{if(f.winning_numbers.find(o=>o.hour==r.hour)){V.error("Ya existe un resultado para este turno");return}D({title:"Confirmar",message:"¿Esta seguro de agregar este resultado?",onConfirm:()=>{r.post(route("clientarea.raffles.winning-numbers.store",f.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),V.success("Guardado correctamente")}})}})};return(o,s)=>(t(),l(T,{title:"Ganadores"},{header:c(()=>[A,u("button",{type:"button",class:"simple-button",onClick:s[0]||(s[0]=e=>p.value=!0)}," Nuevo ")]),default:c(()=>[u("div",E,[(t(!0),n(_,null,b(x.value,e=>(t(),l(w,{stat:e,key:e.title},null,8,["stat"]))),128))]),i.winners.length==0?(t(),n("div",I," No hay transacciones ")):(t(),n("div",M,[(t(!0),n(_,null,b(i.winners,e=>(t(),l(C,{transaction:e,key:e.id},null,8,["transaction"]))),128))])),F(N,{show:p.value,title:"Resultado",onOnCancel:h,onOnSubmit:q},{default:c(()=>[i.hours.length==0?(t(),n("div",Y,' No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en "Horario" ')):(t(),l(O,{key:1,modelValue:a(r).hour,"onUpdate:modelValue":s[1]||(s[1]=e=>a(r).hour=e),text:"Turno",required:""},{default:c(()=>[z,(t(!0),n(_,null,b(i.hours,e=>(t(),n("option",{value:e},m(a(d).create().setTime(e).getTimeFormat()),9,H))),256))]),_:1},8,["modelValue"])),i.settings.date?(t(),l(v,{key:2,modelValue:g.value,"onUpdate:modelValue":s[2]||(s[2]=e=>g.value=e),type:"date",text:"Fecha",required:""},null,8,["modelValue"])):(t(),l(v,{key:3,modelValue:a(r).number,"onUpdate:modelValue":s[3]||(s[3]=e=>a(r).number=e),type:"number",text:"Numero",required:""},null,8,["modelValue"])),L,a(r).number&&a(r).hour?(t(),n("div",P,[k(" Agregando el numero ganador: "),u("span",R,m(a(r).number),1),k(" a la rifa "+m(i.raffle.name)+" para el turno de las "+m(a(d).create().setTime(a(r).hour).getTimeFormat())+" del corriente dia: "+m(a(d).create().format("d/m/Y"))+". ",1)])):B("",!0)]),_:1},8,["show"])]),_:1}))}};export{ne as default};