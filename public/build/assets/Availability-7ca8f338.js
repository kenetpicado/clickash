import{T as M}from"./TableSection-5fcb64cc.js";import{_ as A}from"./FormModal-68566da5.js";import{_ as g}from"./InputForm-644dc0a9.js";import{_ as B}from"./SelectForm-ce08aadd.js";import{C as _}from"./Carbon-e7b34390.js";import{c as F}from"./helpers-5510dcfb.js";import{r as C,T as N,k as O,q as z,o as l,c as i,a as u,v as f,F as v,s as h,A as I,u as s,d as x,b as r,t as d,y as U,O as j}from"./app-f9f355ec.js";import{t as b}from"./toast-fbcec4aa.js";import{I as L}from"./IconEdit-d10a983d.js";import{I as w}from"./IconTrash-18dca70f.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./createVueComponent-3b75edfc.js";const G=r("th",null,"Dia",-1),J=r("th",null,"Horario",-1),K=r("th",null,"Sorteos",-1),P=r("th",null,"Acciones",-1),Q={class:"whitespace-nowrap"},R={class:"badge-primary m-1 whitespace-nowrap"},W={class:"flex items-center gap-3"},X=["onClick"],Y=["onClick"],Z={key:0,value:"",disabled:"",selected:""},ee={key:1,value:"",disabled:"",selected:""},te=["value"],oe={class:"grid grid-cols-2 gap-2"},re={key:1,class:"text-sm text-primaryDark mt-1"},ae=r("div",{class:"mt-4"}," Sorteos agregados ",-1),se={class:"flex gap-3 mt-5"},le={class:"badge-primary"},ie={role:"button",tooltip:"Eliminar"},ge={__name:"Availability",props:{availability:{type:Object,required:!0},raffle:{type:Object,required:!0},openModal:{type:Boolean,required:!0}},emits:["update:openModal"],setup(k,{emit:S}){const c=k,n=C(null),p=C(!0),t=N({id:null,order:null,day:null,start_time:"07:00:00",end_time:"21:00:00",raffle_id:c.raffle.id,blocked_hours:["11:00:00","15:00:00","21:00:00"]}),V=[{order:0,name:"Domingo"},{order:1,name:"Lunes"},{order:2,name:"Martes"},{order:3,name:"Miercoles"},{order:4,name:"Jueves"},{order:5,name:"Viernes"},{order:6,name:"Sabado"}],T=O(()=>{let o=[];return V.forEach(a=>{c.availability.find(e=>e.day==a.name)||o.push(a)}),o});z(()=>t.order,o=>{o&&(t.day=V.find(a=>a.order==o).name)});const y=()=>{t.reset(),p.value=!0,n.value=null,S("update:openModal",!1)},D=o=>{t.id=o.id,t.start_time=o.start_time,t.end_time=o.end_time,t.blocked_hours=o.blocked_hours,p.value=!1,S("update:openModal",!0)},E=()=>{if(!n.value){b.error("Debe seleccionar una hora");return}n.value&&(t.blocked_hours.find(o=>o==n.value+":00")||t.blocked_hours.push(n.value+":00"),n.value=null)},$=()=>{p.value?t.post(route("clientarea.raffles.availability.store",c.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{y(),b.success("Guardado correctamente")}}):t.put(route("clientarea.raffles.availability.update",[c.raffle.id,t.id]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{y(),b.success("Actualizado correctamente")}})},q=o=>{t.blocked_hours.splice(o,1)},H=o=>{F({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{j.delete(route("clientarea.raffles.availability.destroy",[c.raffle.id,o]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b.success("Eliminado correctamente")},onError:a=>{console.log(a)}})}})};return(o,a)=>(l(),i("div",null,[u(M,null,{header:f(()=>[G,J,K,P]),body:f(()=>[(l(!0),i(v,null,h(k.availability,e=>(l(),i("tr",null,[r("td",null,d(e.day),1),r("td",null,[r("span",Q,d(s(_).create().setTime(e.start_time).getTimeFormat())+" - ",1),U(" "+d(s(_).create().setTime(e.end_time).getTimeFormat()),1)]),r("td",null,[(l(!0),i(v,null,h(e.blocked_hours,m=>(l(),i("div",R,d(s(_).create().setTime(m).getTimeFormat()),1))),256))]),r("td",null,[r("div",W,[r("span",{tooltip:"Editar",role:"button",onClick:m=>D(e)},[u(s(L),{size:"22"})],8,X),r("span",{tooltip:"Eliminar",role:"button",onClick:m=>H(e.id)},[u(s(w),{size:"22"})],8,Y)])])]))),256))]),_:1}),u(A,{show:k.openModal,title:"Horario",onOnCancel:y,onOnSubmit:$},{default:f(()=>[p.value?(l(),I(B,{key:0,modelValue:s(t).order,"onUpdate:modelValue":a[0]||(a[0]=e=>s(t).order=e),text:"Dia",required:""},{default:f(()=>[T.value.length>0?(l(),i("option",Z,"Seleccione un dia")):(l(),i("option",ee,"No hay dias disponibles")),(l(!0),i(v,null,h(T.value,e=>(l(),i("option",{value:e.order},d(e.name),9,te))),256))]),_:1},8,["modelValue"])):x("",!0),r("div",oe,[u(g,{text:"Hora incio",modelValue:s(t).start_time,"onUpdate:modelValue":a[1]||(a[1]=e=>s(t).start_time=e),type:"time",required:""},null,8,["modelValue"]),u(g,{text:"Hora fin",modelValue:s(t).end_time,"onUpdate:modelValue":a[2]||(a[2]=e=>s(t).end_time=e),type:"time",required:""},null,8,["modelValue"])]),u(g,{modelValue:n.value,"onUpdate:modelValue":a[3]||(a[3]=e=>n.value=e),type:"time",text:"Sorteo"},null,8,["modelValue"]),r("button",{type:"button",class:"primary-button",onClick:E}," Agregar "),o.$page.props.errors.blocked_hours?(l(),i("p",re,d(o.$page.props.errors.blocked_hours),1)):x("",!0),ae,r("div",se,[(l(!0),i(v,null,h(s(t).blocked_hours,(e,m)=>(l(),i("div",le,[r("span",null,d(s(_).create().setTime(e).getTimeFormat()),1),r("span",ie,[u(s(w),{size:"15",onClick:ne=>q(m),class:"text-rose-600"},null,8,["onClick"])])]))),256))])]),_:1},8,["show"])]))}};export{ge as default};
