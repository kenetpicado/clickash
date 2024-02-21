import{_ as x,a as O}from"./DropdownItem-983f0106.js";import{_ as k}from"./InputForm-2de842c3.js";import{_ as j}from"./SelectForm-e26b1e02.js";import{_ as B}from"./FormModal-ee1967ec.js";import{_ as D}from"./ClientareaLayout-e086a82e.js";import{I as V,c as q}from"./helpers-0b19fc60.js";import{t as f}from"./toast-36f5acc7.js";import{l as S,T as A,o as r,j as I,e as m,b as o,c as i,F as v,k as b,t as d,a as n,u as l,n as U,d as z,O as M}from"./app-153caa5f.js";import{g as T}from"./hours-6727fab9.js";import{I as F}from"./IconEdit-a3aa51c7.js";import"./IconList-e0c53532.js";import"./IconUser-af4f96d7.js";import"./use-resolve-button-type-b87bb079.js";const L=o("span",{class:"title"}," Horario ",-1),G={key:0,class:"w-full text-center text-gray-400"},J={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},K={class:"bg-card p-4 rounded-xl text-gray-600"},P={class:"flex justify-between items-center mb-2"},Q={class:"px-1 py-1"},R=o("h2",{class:"font-semibold mb-2 text-sm"},"Sorteos",-1),W={class:"grid grid-cols-3 lg:grid-cols-4 gap-2"},X=o("option",{value:"",selected:""},"Seleccione un dia",-1),Y=["value"],Z={class:"grid grid-cols-2 gap-2"},ee={key:0,class:"text-sm text-primary mt-1"},te=o("div",{class:"mt-4 mb-2"}," Sorteos ",-1),oe={class:"grid grid-cols-2 lg:grid-cols-3 gap-2"},se={class:"border px-2 py-1 rounded-xl flex items-center justify-between"},re={role:"button"},ye={__name:"Availability",props:{availability:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(g){const p=g,_=S(!1),y=S(!0),c=S(null),t=A({id:null,day:null,start_time:"07:00:00",end_time:"21:00:00",raffle_id:p.raffle.id,blocked_hours:["11:00:00","15:00:00","21:00:00"]}),C=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"],h=()=>{t.reset(),y.value=!0,_.value=!1,c.value=null},$=s=>{t.id=s.id,t.start_time=s.start_time,t.end_time=s.end_time,t.blocked_hours=s.blocked_hours,t.day=s.day,y.value=!1,_.value=!0},H=()=>{if(!c.value){f.error("Seleccione una hora");return}t.blocked_hours.push(c.value)},w=()=>{y.value?t.post(route("clientarea.raffles.availability.store",p.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),f.success("Guardado correctamente")}}):t.put(route("clientarea.raffles.availability.update",[p.raffle.id,t.id]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),f.success("Actualizado correctamente")}})},E=s=>{t.blocked_hours.splice(s,1)},N=s=>{q({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{M.delete(route("clientarea.raffles.availability.destroy",[p.raffle.id,s]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{f.success("Eliminado correctamente")}})}})};return(s,a)=>(r(),I(D,{title:"Horario"},{header:m(()=>[L,o("button",{type:"button",class:"simple-button",onClick:a[0]||(a[0]=e=>_.value=!0)}," Nuevo ")]),default:m(()=>[g.availability.length==0?(r(),i("div",G," No hay horario ")):(r(),i("div",J,[(r(!0),i(v,null,b(g.availability,e=>(r(),i("div",K,[o("div",P,[o("span",null,d(e.day)+": "+d(e.time_label),1),n(O,null,{default:m(()=>[o("div",Q,[n(x,{onClick:u=>$(e),title:"Editar",icon:l(F)},null,8,["onClick","icon"]),n(x,{onClick:u=>N(e.id),title:"Eliminar",icon:l(V)},null,8,["onClick","icon"])])]),_:2},1024)]),R,o("div",W,[(r(!0),i(v,null,b(e.blocked_hours_parsed,u=>(r(),i("div",{class:U(l(T)(u))},d(u),3))),256))])]))),256))])),n(B,{show:_.value,title:"Horario",onOnCancel:h,onOnSubmit:w},{default:m(()=>[n(j,{modelValue:l(t).day,"onUpdate:modelValue":a[1]||(a[1]=e=>l(t).day=e),text:"Dia",name:"day"},{default:m(()=>[X,(r(),i(v,null,b(C,e=>o("option",{value:e},d(e),9,Y)),64))]),_:1},8,["modelValue"]),o("div",Z,[n(k,{text:"Hora incio",modelValue:l(t).start_time,"onUpdate:modelValue":a[2]||(a[2]=e=>l(t).start_time=e),type:"time",required:""},null,8,["modelValue"]),n(k,{text:"Hora fin",modelValue:l(t).end_time,"onUpdate:modelValue":a[3]||(a[3]=e=>l(t).end_time=e),type:"time",required:""},null,8,["modelValue"])]),n(k,{modelValue:c.value,"onUpdate:modelValue":a[4]||(a[4]=e=>c.value=e),type:"time",text:"Sorteo"},null,8,["modelValue"]),o("button",{type:"button",class:"primary-button",onClick:H}," Agregar "),s.$page.props.errors.blocked_hours?(r(),i("p",ee,d(s.$page.props.errors.blocked_hours),1)):z("",!0),te,o("div",oe,[(r(!0),i(v,null,b(l(t).blocked_hours,(e,u)=>(r(),i("div",se,[o("span",null,d(e),1),o("span",re,[n(l(V),{size:"18",onClick:le=>E(u)},null,8,["onClick"])])]))),256))])]),_:1},8,["show"])]),_:1}))}};export{ye as default};
