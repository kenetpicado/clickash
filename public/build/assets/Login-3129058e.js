import{T as g,r as x,a as b,o as d,c,b as n,u as o,Z as h,d as e,t as m,e as w,w as v,f as u,g as y,i as k,F as V}from"./app-e27dafda.js";import{_ as C}from"./Checkbox-28f94ccc.js";import{_ as p}from"./InputForm-90ce5600.js";import{_ as $}from"./Modal-9e846b64.js";const S={class:"min-h-screen flex flex-col sm:justify-center items-center pt-3 sm:pt-0 bg-white px-4 lg:px-0"},j=e("img",{class:"mx-auto h-16 w-auto",src:"/logo1x1.png",alt:"Workflow"},null,-1),N={class:"w-full sm:max-w-md mt-6 px-6 py-8 bg-card shadow-md overflow-hidden rounded-xl"},T=e("h2",{class:"mt-4 text-center text-lg font-extrabold text-basic"}," Inicia sesión ",-1),B={key:0,class:"mb-4 font-medium text-sm text-green-600"},F=["onSubmit"],L=e("button",{type:"submit",class:"w-full primary-button"}," Entrar ",-1),M={class:"flex justify-between text-sm"},U=e("a",{href:"https://play.google.com/store/apps/details?id=com.strainteam.clickashadmin",target:"_blank"},[e("img",{src:"/images/gp.svg",alt:"",style:{width:"15rem"}})],-1),q={class:"p-4 sm:p-6"},E={class:"text-lg font-bold"},H={class:"mt-4 text-gray-600"},I=["innerHTML"],A={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right gap-4"},Z={__name:"Login",props:{status:String,app_name:String,terms_and_conditions:Object},setup(i){const s=g({email:"",password:"",remember:!1}),r=x(!1),f=()=>{s.transform(l=>({...l,remember:s.remember?"on":""})).post(route("login"),{onFinish:()=>s.reset("password")})};return(l,t)=>{const _=b("loading");return d(),c(V,null,[n(o(h),{title:"Inicia sesión"}),n(_,{active:o(s).processing,"is-full-page":!0},null,8,["active"]),e("div",S,[j,e("div",N,[T,i.status?(d(),c("div",B,m(i.status),1)):w("",!0),e("form",{onSubmit:v(f,["prevent"]),class:"mb-6"},[n(p,{text:"Correo",name:"email",modelValue:o(s).email,"onUpdate:modelValue":t[0]||(t[0]=a=>o(s).email=a),type:"email",required:"",autofocus:""},null,8,["modelValue"]),n(p,{text:"Contraseña",name:"password",modelValue:o(s).password,"onUpdate:modelValue":t[1]||(t[1]=a=>o(s).password=a),type:"password",required:""},null,8,["modelValue"]),n(C,{checked:o(s).remember,"onUpdate:checked":t[2]||(t[2]=a=>o(s).remember=a),text:"Recordarme"},null,8,["checked"]),L],40,F),e("div",M,[n(o(k),{href:l.route("register.create"),class:"text-primary font-medium"},{default:u(()=>[y(" Crear cuenta ")]),_:1},8,["href"]),e("div",{class:"text-primary font-medium",onClick:t[3]||(t[3]=a=>r.value=!0)},m(i.terms_and_conditions.title),1)])]),U,n($,{show:r.value,onClose:t[5]||(t[5]=a=>r.value=!1)},{default:u(()=>[e("div",q,[e("div",E,m(i.terms_and_conditions.title),1),e("div",H,[e("span",{innerHTML:i.terms_and_conditions.content,style:{"white-space":"pre-line"}},null,8,I)])]),e("div",A,[e("button",{type:"submit",class:"primary-button",onClick:t[4]||(t[4]=a=>r.value=!1)}," Aceptar ")])]),_:1},8,["show"])])],64)}}};export{Z as default};
