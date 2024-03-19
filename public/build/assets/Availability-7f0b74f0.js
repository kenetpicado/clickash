import{_ as S,a as O}from"./DropdownItem-d971b921.js";import{_ as k}from"./InputForm-23a4ec12.js";import{_ as B}from"./SelectForm-7a721785.js";import{_ as D}from"./FormModal-83e06489.js";import{_ as j}from"./ClientareaLayout-26f14810.js";import{c as q}from"./helpers-6048142e.js";import{t as v}from"./toast-842d54dc.js";import{r as x,T as A,o as r,k as I,f as p,d as o,t as u,c as i,F as b,l as y,b as n,u as l,n as U,e as z,O as M}from"./app-3788295b.js";import{b as T}from"./hours-216088e1.js";import{I as F}from"./IconEdit-a74b37fb.js";import{I as V}from"./IconTrash-7116a7dd.js";import"./createVueComponent-dc029944.js";import"./Modal-65730a3e.js";import"./IconUser-adee7269.js";const L={class:"title"},G={key:0,class:"w-full text-center text-gray-400"},J={key:1,class:"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4"},K={class:"bg-gray-100 p-4 rounded-xl text-gray-600"},P={class:"flex justify-between items-center mb-2"},Q={class:"px-1 py-1"},R=o("h2",{class:"font-semibold mb-2 text-sm"},"Sorteos",-1),W={class:"grid grid-cols-2 lg:grid-cols-3 gap-2"},X=o("option",{value:"",selected:""},"Seleccione un dia",-1),Y=["value"],Z={class:"grid grid-cols-2 gap-2"},ee={key:0,class:"text-sm text-primary mt-1"},te=o("div",{class:"mt-4 mb-2"}," Sorteos ",-1),oe={class:"grid grid-cols-2 lg:grid-cols-3 gap-2"},se={class:"border px-2 py-1 rounded-xl flex items-center justify-between"},re={role:"button"},he={__name:"Availability",props:{availability:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(d){const f=d,_=x(!1),g=x(!0),c=x(null),t=A({id:null,day:null,start_time:"07:00:00",end_time:"21:00:00",raffle_id:f.raffle.id,blocked_hours:["11:00:00","15:00:00","21:00:00"]}),C=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"],h=()=>{t.reset(),g.value=!0,_.value=!1,c.value=null},$=s=>{t.id=s.id,t.start_time=s.start_time,t.end_time=s.end_time,t.blocked_hours=s.blocked_hours,t.day=s.day,g.value=!1,_.value=!0},w=()=>{if(!c.value){v.error("Seleccione una hora");return}t.blocked_hours.push(c.value)},H=()=>{g.value?t.post(route("clientarea.raffles.availability.store",f.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),v.success("Guardado correctamente")}}):t.put(route("clientarea.raffles.availability.update",[f.raffle.id,t.id]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h(),v.success("Actualizado correctamente")}})},E=s=>{t.blocked_hours.splice(s,1)},N=s=>{q({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{M.delete(route("clientarea.raffles.availability.destroy",[f.raffle.id,s]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{v.success("Eliminado correctamente")}})}})};return(s,a)=>(r(),I(j,{title:"Horario"},{header:p(()=>[o("span",L,u(d.raffle.name)+": Horario ",1),o("button",{type:"button",class:"primary-button",onClick:a[0]||(a[0]=e=>_.value=!0)}," Nuevo ")]),default:p(()=>[d.availability.length==0?(r(),i("div",G," No hay horario ")):(r(),i("div",J,[(r(!0),i(b,null,y(d.availability,e=>(r(),i("div",K,[o("div",P,[o("span",null,u(e.day)+": "+u(e.time_label),1),n(O,null,{default:p(()=>[o("div",Q,[n(S,{onClick:m=>$(e),title:"Editar",icon:l(F)},null,8,["onClick","icon"]),n(S,{onClick:m=>N(e.id),title:"Eliminar",icon:l(V)},null,8,["onClick","icon"])])]),_:2},1024)]),R,o("div",W,[(r(!0),i(b,null,y(e.blocked_hours_parsed,m=>(r(),i("div",{class:U(["text-sm text-white text-center rounded-xl py-1",l(T)[d.raffle.id]??"bg-gray-500"])},u(m),3))),256))])]))),256))])),n(D,{show:_.value,title:"Horario",onOnCancel:h,onOnSubmit:H},{default:p(()=>[n(B,{modelValue:l(t).day,"onUpdate:modelValue":a[1]||(a[1]=e=>l(t).day=e),text:"Dia",name:"day"},{default:p(()=>[X,(r(),i(b,null,y(C,e=>o("option",{value:e},u(e),9,Y)),64))]),_:1},8,["modelValue"]),o("div",Z,[n(k,{text:"Hora incio",modelValue:l(t).start_time,"onUpdate:modelValue":a[2]||(a[2]=e=>l(t).start_time=e),type:"time",required:""},null,8,["modelValue"]),n(k,{text:"Hora fin",modelValue:l(t).end_time,"onUpdate:modelValue":a[3]||(a[3]=e=>l(t).end_time=e),type:"time",required:""},null,8,["modelValue"])]),n(k,{modelValue:c.value,"onUpdate:modelValue":a[4]||(a[4]=e=>c.value=e),type:"time",text:"Sorteo"},null,8,["modelValue"]),o("button",{type:"button",class:"primary-button",onClick:w}," Agregar "),s.$page.props.errors.blocked_hours?(r(),i("p",ee,u(s.$page.props.errors.blocked_hours),1)):z("",!0),te,o("div",oe,[(r(!0),i(b,null,y(l(t).blocked_hours,(e,m)=>(r(),i("div",se,[o("span",null,u(e),1),o("span",re,[n(l(V),{size:"18",onClick:le=>E(m)},null,8,["onClick"])])]))),256))])]),_:1},8,["show"])]),_:1}))}};export{he as default};
