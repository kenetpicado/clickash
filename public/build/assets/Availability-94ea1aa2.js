import{_ as S,a as O}from"./DropdownItem-b59cd20f.js";import{_ as k}from"./InputForm-37918877.js";import{_ as D}from"./SelectForm-8c0056df.js";import{_ as j}from"./FormModal-7b0f5bbe.js";import{_ as q}from"./ClientareaLayout-5f4f4b74.js";import{I as V,c as A}from"./helpers-aa058c0e.js";import{t as b}from"./toast-1dad5d10.js";import{r as x,T as I,o as r,k as U,f as m,d as s,t as u,c as a,F as v,l as g,b as n,u as i,n as z,e as M,O as T}from"./app-c30d065f.js";import{I as F}from"./IconEdit-a3f6bc24.js";import"./IconList-18fe5c59.js";import"./IconUser-29de581c.js";import"./use-resolve-button-type-2d2b00d8.js";import"./Modal-b6dcd1b9.js";const L={class:"title"},G={key:0,class:"w-full text-center text-gray-400"},J={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},K={class:"bg-card p-4 rounded-xl text-gray-600"},P={class:"flex justify-between items-center mb-2"},Q={class:"px-1 py-1"},R=s("h2",{class:"font-semibold mb-2 text-sm"},"Sorteos",-1),W={class:"grid grid-cols-3 lg:grid-cols-4 gap-2"},X=s("option",{value:"",selected:""},"Seleccione un dia",-1),Y=["value"],Z={class:"grid grid-cols-2 gap-2"},ee={key:0,class:"text-sm text-primary mt-1"},te=s("div",{class:"mt-4 mb-2"}," Sorteos ",-1),oe={class:"grid grid-cols-2 lg:grid-cols-3 gap-2"},se={class:"border px-2 py-1 rounded-xl flex items-center justify-between"},re={role:"button"},ye={__name:"Availability",props:{availability:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(p){const f=p,_=x(!1),y=x(!0),c=x(null),t=I({id:null,day:null,start_time:"07:00:00",end_time:"21:00:00",raffle_id:f.raffle.id,blocked_hours:["11:00:00","15:00:00","21:00:00"]}),C=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"],h=()=>{t.reset(),y.value=!0,_.value=!1,c.value=null},$=o=>{t.id=o.id,t.start_time=o.start_time,t.end_time=o.end_time,t.blocked_hours=o.blocked_hours,t.day=o.day,y.value=!1,_.value=!0},w=()=>{if(!c.value){b.error("Seleccione una hora");return}t.blocked_hours.push(c.value)},H=()=>{y.value?t.post(route("clientarea.raffles.availability.store",f.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),b.success("Guardado correctamente")}}):t.put(route("clientarea.raffles.availability.update",[f.raffle.id,t.id]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),b.success("Actualizado correctamente")}})},B=o=>{t.blocked_hours.splice(o,1)},E=o=>{A({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{T.delete(route("clientarea.raffles.availability.destroy",[f.raffle.id,o]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b.success("Eliminado correctamente")}})}})};function N(o){return o.includes("11:")?"bg-cyan-600":o.includes("9:")?"bg-indigo-600":o.includes("6:")?"bg-emerald-600":o.includes("3:")?"bg-amber-600":"bg-rose-600"}return(o,l)=>(r(),U(q,{title:"Horario"},{header:m(()=>[s("span",L,u(p.raffle.name)+": Horario ",1),s("button",{type:"button",class:"primary-button",onClick:l[0]||(l[0]=e=>_.value=!0)}," Nuevo ")]),default:m(()=>[p.availability.length==0?(r(),a("div",G," No hay horario ")):(r(),a("div",J,[(r(!0),a(v,null,g(p.availability,e=>(r(),a("div",K,[s("div",P,[s("span",null,u(e.day)+": "+u(e.time_label),1),n(O,null,{default:m(()=>[s("div",Q,[n(S,{onClick:d=>$(e),title:"Editar",icon:i(F)},null,8,["onClick","icon"]),n(S,{onClick:d=>E(e.id),title:"Eliminar",icon:i(V)},null,8,["onClick","icon"])])]),_:2},1024)]),R,s("div",W,[(r(!0),a(v,null,g(e.blocked_hours_parsed,d=>(r(),a("div",{class:z(["text-sm text-white text-center rounded-xl py-1",N(d)])},u(d),3))),256))])]))),256))])),n(j,{show:_.value,title:"Horario",onOnCancel:h,onOnSubmit:H},{default:m(()=>[n(D,{modelValue:i(t).day,"onUpdate:modelValue":l[1]||(l[1]=e=>i(t).day=e),text:"Dia",name:"day"},{default:m(()=>[X,(r(),a(v,null,g(C,e=>s("option",{value:e},u(e),9,Y)),64))]),_:1},8,["modelValue"]),s("div",Z,[n(k,{text:"Hora incio",modelValue:i(t).start_time,"onUpdate:modelValue":l[2]||(l[2]=e=>i(t).start_time=e),type:"time",required:""},null,8,["modelValue"]),n(k,{text:"Hora fin",modelValue:i(t).end_time,"onUpdate:modelValue":l[3]||(l[3]=e=>i(t).end_time=e),type:"time",required:""},null,8,["modelValue"])]),n(k,{modelValue:c.value,"onUpdate:modelValue":l[4]||(l[4]=e=>c.value=e),type:"time",text:"Sorteo"},null,8,["modelValue"]),s("button",{type:"button",class:"primary-button",onClick:w}," Agregar "),o.$page.props.errors.blocked_hours?(r(),a("p",ee,u(o.$page.props.errors.blocked_hours),1)):M("",!0),te,s("div",oe,[(r(!0),a(v,null,g(i(t).blocked_hours,(e,d)=>(r(),a("div",se,[s("span",null,u(e),1),s("span",re,[n(i(V),{size:"18",onClick:le=>B(d)},null,8,["onClick"])])]))),256))])]),_:1},8,["show"])]),_:1}))}};export{ye as default};