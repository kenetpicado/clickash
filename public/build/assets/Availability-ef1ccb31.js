import{_ as q,a as w}from"./DropdownItem-b11691be.js";import{_ as x}from"./InputForm-3bc6c0ab.js";import{_ as B}from"./SelectForm-d84708ec.js";import{_ as j}from"./FormModal-6a4b089d.js";import{_ as A}from"./ClientareaLayout-2116b1de.js";import{C as v}from"./Carbon-e7b34390.js";import{c as I}from"./helpers-7982b481.js";import{t as b}from"./toast-cc00752a.js";import{r as S,T as U,l as M,e as z,o as a,k as $,g as p,b as r,c as i,F as h,f as g,a as d,u as l,d as T,t as u,O as L}from"./app-ee729e55.js";import{I as G}from"./IconEdit-516205f2.js";import{I as H}from"./IconTrash-ecaeaa92.js";import"./IconList-6f12e28f.js";import"./createVueComponent-c1c78ef7.js";import"./IconSettings-d5063921.js";import"./_plugin-vue_export-helper-c27b6911.js";const J=r("span",{class:"title"}," Horario ",-1),K={key:0,class:"w-full text-center text-gray-400"},P={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},Q={class:"bg-card p-4 rounded-xl text-gray-600"},R={class:"flex justify-between items-center mb-2"},W={class:"grid grid-cols-2 gap-2 mb-4"},X=r("strong",{class:"text-sm"},"Hora de inicio",-1),Y=r("strong",{class:"text-sm"},"Hora de fin",-1),Z=r("h2",{class:"font-semibold mb-2 text-sm"},"Sorteos",-1),ee={class:"flex items-center gap-3 overflow-x-auto hide-scrollbar text-sm"},te={class:"inline-flex items-center bg-white px-2 py-1 rounded-xl whitespace-nowrap"},oe={key:0,value:"",disabled:"",selected:""},re={key:1,value:"",disabled:"",selected:""},se=["value"],ae={class:"grid grid-cols-2 gap-2"},le={key:1,class:"text-sm text-primaryDark mt-1"},ie=r("div",{class:"mt-4 mb-2"}," Sorteos ",-1),ne={class:"grid grid-cols-2 lg:grid-cols-3 gap-2"},de={class:"border px-2 py-1 rounded-xl flex items-center justify-between"},ue={role:"button"},$e={__name:"Availability",props:{availability:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(y){const c=y,_=S(!1),f=S(!0),n=S(null),t=U({id:null,order:null,day:null,start_time:"07:00:00",end_time:"21:00:00",raffle_id:c.raffle.id,blocked_hours:["11:00:00","15:00:00","21:00:00"]}),V=[{order:0,name:"Domingo"},{order:1,name:"Lunes"},{order:2,name:"Martes"},{order:3,name:"Miercoles"},{order:4,name:"Jueves"},{order:5,name:"Viernes"},{order:6,name:"Sabado"}],C=M(()=>{let o=[];return V.forEach(s=>{c.availability.find(e=>e.day==s.name)||o.push(s)}),o});z(()=>t.order,o=>{o&&(t.day=V.find(s=>s.order==o).name)});const k=()=>{t.reset(),f.value=!0,_.value=!1,n.value=null},D=o=>{t.id=o.id,t.start_time=o.start_time,t.end_time=o.end_time,t.blocked_hours=o.blocked_hours,f.value=!1,_.value=!0},E=()=>{if(!n.value){b.error("Debe seleccionar una hora");return}n.value&&(t.blocked_hours.find(o=>o==n.value+":00")||t.blocked_hours.push(n.value+":00"),n.value=null)},N=()=>{f.value?t.post(route("clientarea.raffles.availability.store",c.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{k(),b.success("Guardado correctamente")}}):t.put(route("clientarea.raffles.availability.update",[c.raffle.id,t.id]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{k(),b.success("Actualizado correctamente")}})},F=o=>{t.blocked_hours.splice(o,1)},O=o=>{I({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{L.delete(route("clientarea.raffles.availability.destroy",[c.raffle.id,o]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b.success("Eliminado correctamente")}})}})};return(o,s)=>(a(),$(A,{title:"Horario"},{header:p(()=>[J,r("button",{type:"button",class:"simple-button",onClick:s[0]||(s[0]=e=>_.value=!0)}," Nuevo ")]),default:p(()=>[y.availability.length==0?(a(),i("div",K," No hay horario ")):(a(),i("div",P,[(a(!0),i(h,null,g(y.availability,e=>(a(),i("div",Q,[r("div",R,[r("span",null,u(e.day),1),d(q,null,{default:p(()=>[d(w,{onClick:m=>D(e),title:"Editar",icon:l(G)},null,8,["onClick","icon"]),d(w,{onClick:m=>O(e.id),title:"Eliminar",icon:l(H)},null,8,["onClick","icon"])]),_:2},1024)]),r("div",W,[r("div",null,[X,r("div",null,u(l(v).create().setTime(e.start_time).getTimeFormat()),1)]),r("div",null,[Y,r("div",null,u(l(v).create().setTime(e.end_time).getTimeFormat()),1)])]),Z,r("div",ee,[(a(!0),i(h,null,g(e.blocked_hours,m=>(a(),i("div",te,u(l(v).create().setTime(m).getTimeFormat()),1))),256))])]))),256))])),d(j,{show:_.value,title:"Horario",onOnCancel:k,onOnSubmit:N},{default:p(()=>[f.value?(a(),$(B,{key:0,modelValue:l(t).order,"onUpdate:modelValue":s[1]||(s[1]=e=>l(t).order=e),text:"Dia",required:""},{default:p(()=>[C.value.length>0?(a(),i("option",oe,"Seleccione un dia")):(a(),i("option",re,"No hay dias disponibles")),(a(!0),i(h,null,g(C.value,e=>(a(),i("option",{value:e.order},u(e.name),9,se))),256))]),_:1},8,["modelValue"])):T("",!0),r("div",ae,[d(x,{text:"Hora incio",modelValue:l(t).start_time,"onUpdate:modelValue":s[2]||(s[2]=e=>l(t).start_time=e),type:"time",required:""},null,8,["modelValue"]),d(x,{text:"Hora fin",modelValue:l(t).end_time,"onUpdate:modelValue":s[3]||(s[3]=e=>l(t).end_time=e),type:"time",required:""},null,8,["modelValue"])]),d(x,{modelValue:n.value,"onUpdate:modelValue":s[4]||(s[4]=e=>n.value=e),type:"time",text:"Sorteo"},null,8,["modelValue"]),r("button",{type:"button",class:"primary-button",onClick:E}," Agregar "),o.$page.props.errors.blocked_hours?(a(),i("p",le,u(o.$page.props.errors.blocked_hours),1)):T("",!0),ie,r("div",ne,[(a(!0),i(h,null,g(l(t).blocked_hours,(e,m)=>(a(),i("div",de,[r("span",null,u(l(v).create().setTime(e).getTimeFormat()),1),r("span",ue,[d(l(H),{size:"18",onClick:ce=>F(m)},null,8,["onClick"])])]))),256))])]),_:1},8,["show"])]),_:1}))}};export{$e as default};
