import{T as x,r as g,a as b,o as d,c as u,b as a,u as o,Z as w,d as e,t as m,e as h,w as v,f as c,g as y,i as V,F as k}from"./app-7036221c.js";import{_ as C}from"./Checkbox-40ee5c7a.js";import{_ as f}from"./InputForm-81d54900.js";import{_ as $}from"./Modal-c272fae5.js";const S={class:"min-h-screen flex justify-center items-center bg-white px-4 lg:px-0"},j={class:"w-full sm:max-w-md px-6 py-8 bg-gray-100 shadow-md overflow-hidden rounded-xl"},N=e("img",{class:"mx-auto h-16 w-auto",src:"/logo1x1.png",alt:"Workflow"},null,-1),T=e("h2",{class:"mt-4 text-center text-lg font-extrabold text-basic"}," Inicia sesión ",-1),B={key:0,class:"mb-4 font-medium text-sm text-green-600"},F=["onSubmit"],L=e("button",{type:"submit",class:"w-full primary-button"}," Entrar ",-1),M={class:"flex justify-between text-sm"},U={class:"p-4 sm:p-6"},q={class:"text-lg font-bold"},E={class:"mt-4 text-gray-600 max-h-96 overflow-y-auto"},H=["innerHTML"],I={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right gap-4"},W={__name:"Login",props:{status:String,app_name:String,terms_and_conditions:Object},setup(i){const s=x({email:"",password:"",remember:!1}),r=g(!1),p=()=>{s.transform(l=>({...l,remember:s.remember?"on":""})).post(route("login"),{onFinish:()=>s.reset("password")})};return(l,t)=>{const _=b("loading");return d(),u(k,null,[a(o(w),{title:"Inicia sesión"}),a(_,{active:o(s).processing,"is-full-page":!0},null,8,["active"]),e("div",S,[e("div",j,[N,T,i.status?(d(),u("div",B,m(i.status),1)):h("",!0),e("form",{onSubmit:v(p,["prevent"]),class:"mb-6"},[a(f,{text:"Correo",name:"email",modelValue:o(s).email,"onUpdate:modelValue":t[0]||(t[0]=n=>o(s).email=n),type:"email",required:"",autofocus:""},null,8,["modelValue"]),a(f,{text:"Contraseña",name:"password",modelValue:o(s).password,"onUpdate:modelValue":t[1]||(t[1]=n=>o(s).password=n),type:"password",required:""},null,8,["modelValue"]),a(C,{checked:o(s).remember,"onUpdate:checked":t[2]||(t[2]=n=>o(s).remember=n),text:"Recordarme"},null,8,["checked"]),L],40,F),e("div",M,[a(o(V),{href:l.route("register.create"),class:"text-green-pea-500 font-medium"},{default:c(()=>[y(" Crear cuenta ")]),_:1},8,["href"]),e("div",{class:"text-green-pea-500 font-medium",role:"button",onClick:t[3]||(t[3]=n=>r.value=!0)},m(i.terms_and_conditions.title),1)])]),a($,{show:r.value,onClose:t[5]||(t[5]=n=>r.value=!1)},{default:c(()=>[e("div",U,[e("div",q,m(i.terms_and_conditions.title),1),e("div",E,[e("span",{innerHTML:i.terms_and_conditions.content,style:{"white-space":"pre-line"}},null,8,H)])]),e("div",I,[e("button",{type:"submit",class:"primary-button",onClick:t[4]||(t[4]=n=>r.value=!1)}," Aceptar ")])]),_:1},8,["show"])])],64)}}};export{W as default};
