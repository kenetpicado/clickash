import{_ as w}from"./AddButton-6fe6ab91.js";import{_ as m,a as C}from"./DropdownItem-25f38af6.js";import{_ as R}from"./SelectForm-28e34c8f.js";import{_ as V}from"./JsonContent-3ab9722c.js";import{_ as O}from"./FormModal-d389d967.js";import{_ as I}from"./AppLayout-eba4b308.js";import{I as B,c as N}from"./helpers-f36aee11.js";import{t as _}from"./toast-e0c25078.js";import{r as p,o as t,k as h,f as a,d as r,t as v,b as o,c as l,e as q,l as b,u as y,F as g,O as x}from"./app-5b664324.js";import{I as j}from"./IconDeviceWatch-33899c96.js";import"./IconUser-efff4280.js";import"./Modal-35e7beb9.js";import"./IconUsers-00590c9e.js";const A={class:"title"},D={key:0},E=r("p",{class:"text-center text-gray-400"},"No hay rifas disponibles",-1),F=[E],U={class:"grid grid-cols-1 lg:grid-cols-4 gap-4"},H={class:"px-1 py-1"},L=r("option",{selected:"",disabled:"",value:""},"Seleccionar rifa",-1),M=["value"],ae={__name:"Show",props:{user:{type:Object,required:!0},raffles:{type:Object,required:!0}},setup(s){const c=s,S=[{name:"Inicio",route:route("dashboard.index")},{name:"Usuarios",route:route("dashboard.users.index")},{name:"Rifas",route:window.location.href}],u=p(!1),i=p(null);function $(d){N({message:"Are you sure you want to delete this raffle?",onConfirm:()=>{x.delete(route("dashboard.users.raffles.destroy",[c.user.id,d]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{_.success("Raffle deleted successfully")}})}})}function f(){i.value=null,u.value=!1}function k(){x.post(route("dashboard.users.raffles.store",c.user.id),{raffle_id:i.value},{onSuccess:()=>{_.success("Raffle added successfully"),f()}})}return(d,n)=>(t(),h(I,{title:"Rifas",breads:S},{header:a(()=>[r("span",A," Rifas de: "+v(s.user.name),1),o(w,{onClick:n[0]||(n[0]=e=>u.value=!0)})]),default:a(()=>[s.user.raffles.length==0?(t(),l("div",D,F)):q("",!0),r("div",U,[(t(!0),l(g,null,b(s.user.raffles,e=>(t(),h(V,{title:e.name,content:e.settings},{default:a(()=>[o(C,null,{default:a(()=>[r("div",H,[o(m,{href:d.route("dashboard.users.raffles.availability.index",[s.user.id,e.id]),title:"Horario",icon:y(j)},null,8,["href","icon"]),o(m,{onClick:T=>$(e.id),title:"Eliminar",icon:y(B)},null,8,["onClick","icon"])])]),_:2},1024)]),_:2},1032,["title","content"]))),256))]),o(O,{show:u.value,title:"Rifas",onOnCancel:f,onOnSubmit:k},{default:a(()=>[o(R,{text:"Rifas disponibles",modelValue:i.value,"onUpdate:modelValue":n[1]||(n[1]=e=>i.value=e),required:""},{default:a(()=>[L,(t(!0),l(g,null,b(s.raffles,e=>(t(),l("option",{value:e.id},v(e.name),9,M))),256))]),_:1},8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{ae as default};