import{T as p,o as l,c as i,a as r,u as t,b as s,t as d,d as f,w as x,n as _,F as g,Z as b}from"./app-e6f78d54.js";import{_ as w}from"./Checkbox-b153ea6b.js";import{_ as c}from"./InputForm-1c7c7af7.js";const h={class:"min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 px-4 lg:px-0"},y={class:"w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-xl"},V=s("img",{class:"mx-auto h-20 w-auto",src:"logo-simple.png",alt:"Workflow"},null,-1),k={class:"mt-4 text-center text-2xl font-extrabold text-gray-900"},v=s("p",{class:"mt-2 text-center text-sm text-gray-600"}," Inicia sesión con tu cuenta ",-1),S={key:0,class:"mb-4 font-medium text-sm text-green-600"},C=["onSubmit"],j={class:"flex items-center justify-end mt-4"},B=["disabled"],q={__name:"Login",props:{status:String,app_name:String},setup(n){const e=p({email:"jmercadomorales9@gmail.com",password:"password",remember:!1}),u=()=>{e.transform(m=>({...m,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(m,o)=>(l(),i(g,null,[r(t(b),{title:"Log in"}),s("div",h,[s("div",y,[s("div",null,[V,s("h2",k,d(n.app_name),1),v]),n.status?(l(),i("div",S,d(n.status),1)):f("",!0),s("form",{onSubmit:x(u,["prevent"])},[r(c,{text:"Correo",name:"email",modelValue:t(e).email,"onUpdate:modelValue":o[0]||(o[0]=a=>t(e).email=a),type:"email",required:"",autofocus:""},null,8,["modelValue"]),r(c,{text:"Contraseña",name:"password",modelValue:t(e).password,"onUpdate:modelValue":o[1]||(o[1]=a=>t(e).password=a),type:"password",required:""},null,8,["modelValue"]),r(w,{checked:t(e).remember,"onUpdate:checked":o[2]||(o[2]=a=>t(e).remember=a),text:"Recordarme"},null,8,["checked"]),s("div",j,[s("button",{type:"submit",class:_(["primary-button",t(e).processing?"opacity-25":""]),disabled:t(e).processing}," Entrar ",10,B)])],40,C)])])],64))}};export{q as default};