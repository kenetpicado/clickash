import{r as x,T as y,o as d,k as h,f as p,d as e,u as s,t as l,c as m,e as v,b as r,w as b}from"./app-7036221c.js";import{A as g,_ as V}from"./ClientareaLayout-60ab41ff.js";import{_ as u}from"./InputForm-81d54900.js";import{t as k}from"./toast-9b4598a6.js";import{I as C}from"./DropdownItem-236e3c27.js";import{c as I}from"./IconUser-057cecd7.js";import{I as S}from"./IconUsers-08dc663d.js";var w=I("record-mail","IconRecordMail",[["path",{d:"M7 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0",key:"svg-0"}],["path",{d:"M17 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0",key:"svg-1"}],["path",{d:"M7 15l10 0",key:"svg-2"}]]);const M=e("span",{class:"title"}," Perfil ",-1),N={class:"bg-gray-100 p-4 rounded-xl flex flex-col items-center gap-2 mb-4"},U=["src"],$={class:"font-bold text-xl"},j={class:"text-sm text-gray-400"},q={class:"flex justify-between items-center mb-4"},A=e("span",null,"Información",-1),B={key:0,class:"mb-4"},E={class:"flex items-center gap-4 mb-4"},P={class:"text-gray-400"},R={class:"flex flex-col"},z=e("span",null,"Compañia",-1),D={class:"text-gray-400"},G={class:"flex items-center gap-4 mb-4"},L={class:"text-gray-400"},O={class:"flex flex-col"},T=e("span",null,"Correo",-1),F={class:"text-gray-400"},H={class:"flex items-center gap-4 mb-4"},J={class:"text-gray-400"},K={class:"flex flex-col"},Q=e("span",null,"Vendedores",-1),W={class:"text-gray-400"},X={key:1},Y=["onSubmit"],Z={class:"flex items-center gap-4 justify-end"},ee=e("button",{class:"primary-button"}," Guardar ",-1),ie={__name:"Index",props:{user:{type:Object,required:!0}},setup(o){const i=o,c=x(!1),a=y({id:i.user.id,name:i.user.name,email:i.user.email,company_name:i.user.company_name});function _(){a.put(route("clientarea.profile.update",a.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{k.success("Perfil actualizado correctamente")}})}return(f,t)=>(d(),h(V,{title:"Perfil"},{header:p(()=>[M]),default:p(()=>[e("div",N,[e("img",{src:s(g)(f.$page.props.auth.name),class:"w-20 h-20 object-cover rounded-full",alt:""},null,8,U),e("span",$,l(o.user.name),1),e("span",j,l(o.user.role=="owner"?"Administrador":"Vendedor"),1)]),e("div",q,[A,c.value?v("",!0):(d(),m("button",{key:0,onClick:t[0]||(t[0]=n=>c.value=!0),type:"button",class:"primary-button"},"Editar"))]),c.value?(d(),m("div",X,[e("form",{onSubmit:b(_,["prevent"]),class:"mb-8"},[r(u,{text:"Nombre",modelValue:s(a).name,"onUpdate:modelValue":t[1]||(t[1]=n=>s(a).name=n),required:""},null,8,["modelValue"]),r(u,{text:"Compañia",modelValue:s(a).company_name,"onUpdate:modelValue":t[2]||(t[2]=n=>s(a).company_name=n),required:""},null,8,["modelValue"]),r(u,{text:"Correo",modelValue:s(a).email,"onUpdate:modelValue":t[3]||(t[3]=n=>s(a).email=n),type:"email",required:""},null,8,["modelValue"]),e("div",Z,[e("button",{type:"button",onClick:t[4]||(t[4]=n=>c.value=!1),class:"secondary-button"},"Cancelar"),ee])],40,Y)])):(d(),m("div",B,[e("div",E,[e("span",P,[r(s(C),{class:"text-primary"})]),e("div",R,[z,e("span",D,l(o.user.company_name??"N/A"),1)])]),e("div",G,[e("span",L,[r(s(w),{class:"text-primary"})]),e("div",O,[T,e("span",F,l(o.user.email),1)])]),e("div",H,[e("span",J,[r(s(S),{class:"text-primary"})]),e("div",K,[Q,e("span",W,l(o.user.sellers_count??0)+" / "+l(o.user.sellers_limit),1)])])]))]),_:1}))}};export{ie as default};
