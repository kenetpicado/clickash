import{O as x,r as y,T as b,o as i,k as v,f as _,d as e,t as l,c as d,b as r,u as s,F as h,w as g}from"./app-ae25cce0.js";import{_ as k}from"./ClientareaLayout-901333af.js";import{_ as u}from"./InputForm-acb6448b.js";import{t as V}from"./toast-b46a3799.js";import{I as C}from"./IconList-78577ca8.js";import{c as I}from"./IconUser-0a386455.js";import{I as S}from"./IconUsers-3eafa523.js";var w=I("record-mail","IconRecordMail",[["path",{d:"M7 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0",key:"svg-0"}],["path",{d:"M17 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0",key:"svg-1"}],["path",{d:"M7 15l10 0",key:"svg-2"}]]);function M(){function o(){x.post(route("logout"))}return{logout:o}}const q=e("span",{class:"title"}," Perfil ",-1),B={class:"bg-card p-4 rounded-xl flex flex-col items-center gap-2 mb-4"},N=e("img",{src:"/profile.png",class:"w-20 h-20 object-cover rounded-full",alt:""},null,-1),U={class:"font-bold text-xl"},$={class:"text-sm text-gray-400"},j={class:"flex justify-between items-center mb-4"},A=e("span",null,"Información",-1),E={class:"mb-4"},O={class:"flex items-center gap-4 mb-4"},P={class:"text-gray-400"},F={class:"flex flex-col"},R=e("span",null,"Compañia",-1),z={class:"text-gray-400"},D={class:"flex items-center gap-4 mb-4"},G={class:"text-gray-400"},L={class:"flex flex-col"},T=e("span",null,"Correo",-1),H={class:"text-gray-400"},J={class:"flex items-center gap-4 mb-4"},K={class:"text-gray-400"},Q={class:"flex flex-col"},W=e("span",null,"Vendedores",-1),X={class:"text-gray-400"},Y={key:1},Z=["onSubmit"],ee=e("button",{class:"primary-button flex ml-auto mb-6"}," Guardar ",-1),ce={__name:"Index",props:{user:{type:Object,required:!0}},setup(o){const c=o,{logout:p}=M(),m=y(!1),n=b({id:c.user.id,name:c.user.name,email:c.user.email,company_name:c.user.company_name});function f(){n.put(route("clientarea.profile.update",n.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{V.success("Perfil actualizado correctamente")}})}return(te,t)=>(i(),v(k,{title:"Perfil"},{header:_(()=>[q]),default:_(()=>[e("div",B,[N,e("span",U,l(o.user.name),1),e("span",$,l(o.user.role=="owner"?"Administrador":"Vendedor"),1)]),e("div",j,[A,m.value?(i(),d("button",{key:1,onClick:t[1]||(t[1]=a=>m.value=!1),type:"button",class:"simple-button"},"Cancelar")):(i(),d("button",{key:0,onClick:t[0]||(t[0]=a=>m.value=!0),type:"button",class:"simple-button"},"Editar"))]),m.value?(i(),d("div",Y,[e("form",{onSubmit:g(f,["prevent"])},[r(u,{text:"Nombre",modelValue:s(n).name,"onUpdate:modelValue":t[3]||(t[3]=a=>s(n).name=a),required:""},null,8,["modelValue"]),r(u,{text:"Compañia",modelValue:s(n).company_name,"onUpdate:modelValue":t[4]||(t[4]=a=>s(n).company_name=a),required:""},null,8,["modelValue"]),r(u,{text:"Correo",modelValue:s(n).email,"onUpdate:modelValue":t[5]||(t[5]=a=>s(n).email=a),type:"email",required:""},null,8,["modelValue"]),ee],40,Z)])):(i(),d(h,{key:0},[e("div",E,[e("div",O,[e("span",P,[r(s(C),{class:"text-primary"})]),e("div",F,[R,e("span",z,l(o.user.company_name??"N/A"),1)])]),e("div",D,[e("span",G,[r(s(w),{class:"text-primary"})]),e("div",L,[T,e("span",H,l(o.user.email),1)])]),e("div",J,[e("span",K,[r(s(S),{class:"text-primary"})]),e("div",Q,[W,e("span",X,l(o.user.sellers_count??0)+" / "+l(o.user.sellers_limit),1)])])]),e("button",{onClick:t[2]||(t[2]=(...a)=>s(p)&&s(p)(...a)),type:"button",class:"flex primary-button mx-auto mb-6"}," Cerrar sesión ")],64))]),_:1}))}};export{ce as default};