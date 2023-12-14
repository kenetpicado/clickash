import{r as b,T as V,g as $,o,c as r,b as l,F as h,h as C,t as d,a as i,e as c,u as s,d as _,j as I}from"./app-a6ad3736.js";import{_ as w}from"./FormModal-6d671308.js";import{_ as m}from"./InputForm-b282130a.js";import{_ as v}from"./Checkbox-3c201b69.js";import{t as M}from"./toast-2685acd3.js";import{_ as u,I as U,a as S}from"./Dropdown-4aec7fcc.js";import{I as N,a as q}from"./IconReportAnalytics-1e034b22.js";import{c as x}from"./createVueComponent-68211735.js";import{I as D}from"./IconDeviceWatch-535e9dd3.js";import{_ as j}from"./Tabs-28e9e1ea.js";import{_ as L}from"./ClientareaLayout-3d9f02eb.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./IconList-dbfbcade.js";var O=x("number","IconNumber",[["path",{d:"M4 17v-10l7 10v-10",key:"svg-0"}],["path",{d:"M15 17h5",key:"svg-1"}],["path",{d:"M17.5 10m-2.5 0a2.5 3 0 1 0 5 0a2.5 3 0 1 0 -5 0",key:"svg-2"}]]),R=x("user-check","IconUserCheck",[["path",{d:"M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0",key:"svg-0"}],["path",{d:"M6 21v-2a4 4 0 0 1 4 -4h4",key:"svg-1"}],["path",{d:"M15 19l2 2l4 -4",key:"svg-2"}]]);const B={class:"grid grid-cols-1 lg:grid-cols-3 gap-4"},F={class:"bg-card rounded-xl p-2 w-full"},A={class:"flex justify-between text-gray-600"},E={class:"px-1 py-1"},T={class:"px-1 py-1"},X={class:"flex items-center gap-2 mb-3"},z=l("div",{class:"bg-white rounded-xl"},[l("img",{src:"/games.png",alt:"",class:"w-20 h-20"})],-1),G={class:"flex flex-col gap-1 text-xs"},H={key:0},W={key:1},J={key:2},K={class:"w-full text-center bg-white py-1 rounded-xl text-primary text-xs"},P={key:0},Q={key:1},Y={class:"grid grid-cols-2 gap-4"},Z={class:"grid grid-cols-2 gap-4 mb-1"},ee={key:0,class:"grid grid-cols-2 gap-4"},te={__name:"RaffleTab",props:{raffles:{type:Object,required:!0}},setup(g){const p=b(!1),t=V({raffle_name:null,raffle_id:null,settings:{super_x:!0,date:!1,min:null,max:null,general_limit:null,individual_limit:null,multiplier:70}});function y(a){t.raffle_name=a.raffle.name,t.raffle_id=a.raffle_id,Object.assign(t.settings,a.settings),p.value=!0}function k(){t.put(route("clientarea.raffles.update",t.raffle_id),{preserveScroll:!0,onSuccess:()=>{f(),M.success("Rifa actualizada")}})}const f=()=>{t.reset(),p.value=!1};return $(()=>t.settings.date,a=>{a&&(t.settings.min=null,t.settings.max=null)}),(a,n)=>(o(),r(h,null,[l("div",B,[(o(!0),r(h,null,C(g.raffles,e=>(o(),r("div",F,[l("div",A,[l("span",null,d(e.raffle.name),1),i(S,null,{default:c(()=>[l("div",E,[i(u,{href:a.route("clientarea.raffles.show",e.raffle_id),title:"Ventas",icon:s(N)},null,8,["href","icon"]),i(u,{href:a.route("clientarea.raffles.winning-numbers.index",e.raffle_id),title:"Ganadores",icon:s(R)},null,8,["href","icon"]),i(u,{href:a.route("clientarea.raffles.reports",e.raffle_id),title:"Reportes",icon:s(q)},null,8,["href","icon"])]),l("div",T,[i(u,{href:a.route("clientarea.raffles.blocked-numbers.index",e.raffle_id),title:"Dígitos bloqueados",icon:s(O)},null,8,["href","icon"]),i(u,{href:a.route("clientarea.raffles.availability.index",e.raffle_id),title:"Horario",icon:s(D)},null,8,["href","icon"]),i(u,{onClick:ie=>y(e),title:"Configuración",icon:s(U)},null,8,["onClick","icon"])])]),_:2},1024)]),l("div",X,[z,l("div",G,[l("span",null,"Super X: "+d(e.settings.super_x?"Activado":"Desactivado"),1),e.settings.general_limit?(o(),r("span",H," Limite general: C$"+d(e.settings.general_limit),1)):_("",!0),e.settings.individual_limit?(o(),r("span",W," Limite individual: C$"+d(e.settings.individual_limit),1)):_("",!0),e.settings.multiplier?(o(),r("span",J," Multiplicador: "+d(e.settings.multiplier),1)):_("",!0)])]),l("div",K,[e.settings.date?(o(),r("span",P," Fecha ")):(o(),r("span",Q," Desde "+d(e.settings.min)+" hasta "+d(e.settings.max),1))])]))),256))]),i(w,{show:p.value,title:s(t).raffle_name,onOnCancel:f,onOnSubmit:k},{default:c(()=>[l("div",Y,[i(m,{text:"Limite general C$",modelValue:s(t).settings.general_limit,"onUpdate:modelValue":n[0]||(n[0]=e=>s(t).settings.general_limit=e),type:"number"},null,8,["modelValue"]),i(m,{text:"Limite indiv. C$",modelValue:s(t).settings.individual_limit,"onUpdate:modelValue":n[1]||(n[1]=e=>s(t).settings.individual_limit=e),type:"number"},null,8,["modelValue"])]),l("div",Z,[i(v,{checked:s(t).settings.super_x,"onUpdate:checked":n[2]||(n[2]=e=>s(t).settings.super_x=e),text:"Super X"},null,8,["checked"]),i(v,{checked:s(t).settings.date,"onUpdate:checked":n[3]||(n[3]=e=>s(t).settings.date=e),text:"Fecha"},null,8,["checked"])]),s(t).settings.date?_("",!0):(o(),r("div",ee,[i(m,{text:"Número inicio",modelValue:s(t).settings.min,"onUpdate:modelValue":n[4]||(n[4]=e=>s(t).settings.min=e),required:"",type:"number"},null,8,["modelValue"]),i(m,{text:"Número final",modelValue:s(t).settings.max,"onUpdate:modelValue":n[5]||(n[5]=e=>s(t).settings.max=e),required:"",type:"number"},null,8,["modelValue"])])),i(m,{text:"Multiplicador",modelValue:s(t).settings.multiplier,"onUpdate:modelValue":n[6]||(n[6]=e=>s(t).settings.multiplier=e),type:"number",required:""},null,8,["modelValue"])]),_:1},8,["show","title"])],64))}},se=l("span",{class:"title"}," Rifas ",-1),he={__name:"Index",props:{raffles:{type:Object,required:!0}},setup(g){return(p,t)=>(o(),I(L,{title:"Inicio"},{options:c(()=>[i(j)]),header:c(()=>[se]),default:c(()=>[i(te,{raffles:g.raffles},null,8,["raffles"])]),_:1}))}};export{he as default};
