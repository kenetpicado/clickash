import{_ as O}from"./AddButton-1f1b3f7d.js";import{_,a as $}from"./Dropdown-32dafc7e.js";import{_ as k}from"./SelectForm-e031f7c1.js";import{_ as C}from"./FormModal-bc7d11da.js";import{_ as R}from"./AppLayout-e4abc83d.js";import{I as V,c as j}from"./helpers-23c84eb7.js";import{t as p}from"./toast-724cb485.js";import{l as h,o,g as q,e as r,b as s,t as n,a as t,c as u,k as v,u as b,F as y,O as g}from"./app-cddf73c5.js";import{I as B}from"./IconDeviceWatch-cd80a901.js";import"./IconUser-398f2c6f.js";import"./use-resolve-button-type-d1a32c24.js";import"./IconList-dd0be378.js";import"./IconUsers-6bdbd737.js";import"./_plugin-vue_export-helper-c27b6911.js";const I={class:"title"},N={class:"grid grid-cols-1 lg:grid-cols-4 gap-4"},A={class:"bg-card rounded-xl p-2 w-full"},D={class:"flex justify-between"},E={class:"mb-2"},F={class:"px-1 py-1"},H={class:"text-xs text-gray-600"},U={class:"bg-white w-full p-3"},J=s("option",{selected:"",disabled:"",value:""},"Seleccionar rifa",-1),L=["value"],oe={__name:"Show",props:{user:{type:Object,required:!0},raffles:{type:Object,required:!0},all_raffles:{type:Object,required:!0}},setup(a){const f=a,x=[{name:"Home",route:route("dashboard.users.index")},{name:"Usuarios",route:route("dashboard.users.index")}],d=h(!1),i=h(null);function S(c){j({message:"Are you sure you want to delete this raffle?",onConfirm:()=>{g.delete(route("dashboard.users.raffles.destroy",[f.user.id,c]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p.success("Raffle deleted successfully")}})}})}function m(){i.value=null,d.value=!1}function w(){g.post(route("dashboard.users.raffles.store",f.user.id),{raffle_id:i.value},{onSuccess:()=>{p.success("Raffle added successfully"),m()}})}return(c,l)=>(o(),q(R,{title:"Rifas",breads:x},{header:r(()=>[s("span",I," Rifas de: "+n(a.user.name),1),t(O,{onClick:l[0]||(l[0]=e=>d.value=!0)})]),default:r(()=>[s("div",N,[(o(!0),u(y,null,v(a.raffles,e=>(o(),u("div",A,[s("div",D,[s("span",E,n(e.name),1),t($,null,{default:r(()=>[s("div",F,[t(_,{href:c.route("dashboard.users.raffles.availability.index",[a.user.id,e.id]),title:"Horario",icon:b(B)},null,8,["href","icon"]),t(_,{onClick:M=>S(e.id),title:"Eliminar",icon:b(V)},null,8,["onClick","icon"])])]),_:2},1024)]),s("div",H,[s("pre",U,n(JSON.parse(e.pivot.settings)),1)])]))),256))]),t(C,{show:d.value,title:"Rifas",onOnCancel:m,onOnSubmit:w},{default:r(()=>[t(k,{text:"Rifas disponibles",modelValue:i.value,"onUpdate:modelValue":l[1]||(l[1]=e=>i.value=e),required:""},{default:r(()=>[J,(o(!0),u(y,null,v(a.all_raffles,e=>(o(),u("option",{value:e.id},n(e.name),9,L))),256))]),_:1},8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{oe as default};
