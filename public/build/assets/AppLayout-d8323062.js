import{o as s,c as a,b as e,a as o,e as u,u as t,i as h,F as f,l as v,t as p,g as _,z as g,A as w,O as C,Z as I,d as x,n as y}from"./app-0d1166d4.js";import{I as b}from"./IconUsers-3a496eae.js";import{c as k,I as $,a as S}from"./IconUser-d74c1992.js";var A=k("chevron-right","IconChevronRight",[["path",{d:"M9 6l6 6l-6 6",key:"svg-0"}]]),L=k("logout","IconLogout",[["path",{d:"M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2",key:"svg-0"}],["path",{d:"M9 12h12l-3 -3",key:"svg-1"}],["path",{d:"M18 15l3 -3",key:"svg-2"}]]);const B={class:"w-72 p-3 flex flex-col hidden lg:block min-h-screen"},M={class:"flex flex-col items-center my-1"},N=e("div",{class:"h-14 my-6"},[e("img",{class:"h-full w-full object-contain",src:"/logo1x1.png",alt:""})],-1),U={class:"space-y-2 text-basic"},V={key:0,class:"block text-xs text-gray-400 uppercase tracking-wider mt-2 px-2"},D=e("span",null,"Perfil",-1),F=e("span",null,"Salir",-1),O={__name:"Sidebar",setup(r){const c=b,m=()=>{C.post(route("logout"))},i=[{header:"Administración"},{name:"Usuarios",route:route("dashboard.users.index"),icon:b},{name:"Rifas",route:route("dashboard.raffles.index"),icon:$},{header:"Sistema"}];function d(n){return window.location.href==n?"bg-card":"hover:bg-card"}return(n,Z)=>(s(),a("aside",B,[e("div",M,[o(t(h),{href:n.route("home")},{default:u(()=>[N]),_:1},8,["href"])]),e("ul",U,[(s(),a(f,null,v(i,l=>e("li",null,[l.header?(s(),a("span",V,p(l.header),1)):(s(),_(t(h),{key:1,href:l.route},{default:u(()=>[e("span",{class:g(["flex items-center px-2 py-3 rounded-lg gap-4",d(l.route)])},[(s(),_(w(l.icon??t(c)))),e("span",null,p(l.name),1)],2)]),_:2},1032,["href"]))])),64)),e("li",null,[o(t(h),{href:n.route("profile.index")},{default:u(()=>[e("span",{class:g(["flex items-center px-2 py-3 rounded-lg gap-4",d(n.route("profile.index"))])},[o(t(S)),D],2)]),_:1},8,["href"])]),e("li",null,[e("span",{onClick:m,class:"flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100",role:"button"},[o(t(L)),F])])])]))}},R={class:"flex w-full"},j={class:"w-full p-4 lg:p-8"},z={key:0,class:"flex items-center mb-4"},E={class:"flex items-center"},G={class:"text-sm me-2 tracking-wider text-basic"},P={class:"w-full"},T={class:"flex items-center justify-between h-10 mb-6 text-basic"},K={__name:"AppLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(r){return(c,m)=>(s(),a(f,null,[o(t(I),{title:r.title},null,8,["title"]),e("section",R,[o(O),e("main",j,[r.breads.length>0?(s(),a("ol",z,[(s(!0),a(f,null,v(r.breads,(i,d)=>(s(),a("li",E,[d!=0?(s(),_(t(A),{key:0,class:"text-gray-300"})):x("",!0),o(t(h),{href:i.route},{default:u(()=>[e("span",G,p(i.name),1)]),_:2},1032,["href"])]))),256))])):x("",!0),e("div",P,[e("div",T,[y(c.$slots,"header")]),y(c.$slots,"default")])])])],64))}};export{K as _};