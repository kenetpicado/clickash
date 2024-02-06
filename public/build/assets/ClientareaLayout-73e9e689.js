import{o as r,c as n,a as s,e as c,j as g,z as y,y as f,u as o,i as d,t as p,d as x,Z as w,b as a,f as _,m as i,F as v,h as b}from"./app-ff81f535.js";import{c as u,I as k,a as I}from"./IconUser-aede0555.js";var M=u("currency-dollar","IconCurrencyDollar",[["path",{d:"M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2",key:"svg-0"}],["path",{d:"M12 3v3m0 12v3",key:"svg-1"}]]),C=u("home","IconHome",[["path",{d:"M5 12l-2 0l9 -9l9 9l-2 0",key:"svg-0"}],["path",{d:"M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7",key:"svg-1"}],["path",{d:"M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6",key:"svg-2"}]]),j=u("users-group","IconUsersGroup",[["path",{d:"M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1",key:"svg-1"}],["path",{d:"M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-2"}],["path",{d:"M17 10h2a2 2 0 0 1 2 2v1",key:"svg-3"}],["path",{d:"M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-4"}],["path",{d:"M3 13v-1a2 2 0 0 1 2 -2h2",key:"svg-5"}]]);const $={class:"flex items-center justify-center flex-col"},B={key:0,class:"text-xs text-gray-600"},N={__name:"NavItem",props:{item:{type:Object,required:!0},active:{type:Boolean,default:!1}},setup(t){return(h,m)=>(r(),n("div",$,[s(o(d),{href:t.item.route,class:f(["inline-flex items-center justify-center w-10 h-10 font-medium rounded-full group",t.active?"bg-primary":"bg-transparent"])},{default:c(()=>[(r(),g(y(t.item.icon),{class:f(t.active?"w-4 h-4 text-white":"w-5 h-5 text-gray-600")},null,8,["class"]))]),_:1},8,["href","class"]),t.item.title?(r(),n("span",B,p(t.item.title),1)):x("",!0)]))}},V={class:"bg-white border gray-200 shadow"},D={class:"flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg"},z=a("img",{src:"/profile.png",class:"w-10 h-10 object-cover rounded-full border-2 border-white",alt:""},null,-1),G={class:"p-4 mx-auto max-w-screen-lg mb-12"},S={class:"flex items-center overflow-x-auto hide-scrollbar"},U={class:"flex items-center justify-between mb-4 text-gray-600"},A={class:"fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-card rounded-full bottom-2 left-1/2"},F={class:"grid h-full max-w-lg grid-cols-5 mx-auto"},E={__name:"ClientareaLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(t){const h=[{icon:j,route:route("clientarea.sellers.index")},{icon:M,route:route("clientarea.transactions.index")},{icon:C,route:route("clientarea.index")},{icon:k,route:route("clientarea.results.index")},{icon:I,route:route("clientarea.profile.index")}],m=e=>e===route("clientarea.index")?window.location.pathname==="/clientarea":window.location.href.includes(e);return(e,H)=>(r(),n(v,null,[s(o(w),{title:t.title},null,8,["title"]),a("nav",V,[a("div",D,[s(o(d),{href:e.route("clientarea.index"),class:"font-bold text-lg text-gray-600"},{default:c(()=>[_(p(e.$page.props.app_name),1)]),_:1},8,["href"]),s(o(d),{href:e.route("clientarea.profile.index"),class:"font-bold text-lg text-gray-600"},{default:c(()=>[z]),_:1},8,["href"])])]),a("main",G,[a("div",S,[i(e.$slots,"options")]),a("div",U,[i(e.$slots,"header")]),i(e.$slots,"default")]),a("div",A,[a("div",F,[(r(),n(v,null,b(h,l=>s(N,{key:l.route,item:l,active:m(l.route)},null,8,["item","active"])),64))])])],64))}};export{M as I,E as _};