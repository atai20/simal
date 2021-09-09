uses graphABC,abcOBJECTS;  
VAR
 x,y,k,l,h,u,z,d,j,jd,ft,xe,ye,s,dosta,end1,eco,evilhand1,handevil3,evildosta,handevil,opi,hj,dosta2,c,b,hj2,end2,atakport,more,pula,healthportal,healthcastle,healthcastle2,healthevil,healthportal2,healthcircle,healthcircle2:integer;
 oz,kol,youwin,youlose ,evilhand,evil,poi,evilhealth,perv,poi1,poi2,poi3,poi4,kol1:picture;
 
 //процедура нажатия кнопки
 procedure keydown(key:integer);
 begin
 if key=vk_q then begin
  eco:=1;
 end;
 if end2=0 then begin
 if key=vk_left then begin
 dosta:=1;
 dosta2:=1;
 end;
 if key=vk_right then begin
 dosta:=2;
 dosta2:=2;

 end;

  if (key=vk_space) and (y+28=l) then begin
  d:=1;
  jd:=0;

  end;
  if (key=vk_space) and (jd=1) then begin
  d:=1;
  jd:=0;
  y:=y+1;
  l:=l+1;
  end;
  if (key=vk_z) then begin
  if (healthportal<590)and (x>485)and (x<650)then begin
 atakport:=1;
 end;
  
  more:=1;
    if (healthportal>590)then begin
 end1:=1;
 end;
sleep(200);
  more:=0;


end;
 end;
 if end2=1 then begin
  if key= vk_enter then begin
l:=309;
y:=191;
x:=100;
c:=550;
hj:=500;
opi:=0;
z:=10;
ye:=y;
dosta2:=2;
healthcastle:=400;
healthportal2:=400;
healthportal:=400;
healthcircle:=510;
healthevil:=0;
xe:=x;
d:=0;
   end2:=0;
   end1:=0;

  end;
 end;
 end;
 
 
 
 



BEGIN
l:=400;
y:=100;
x:=100;
c:=550;
hj:=500;
z:=10;

handevil:=62;
handevil3:=handevil-10;
ye:=y;
dosta2:=2;
healthcastle:=400;
healthportal2:=400;
healthportal:=400;
healthcircle:=510;
xe:=x;
d:=0;

//строка, не позволяющая фиксировать размер окна
window.IsFixedSize:=true; 

//текст в начале
textout(10,220,'Жил был шар, по имени Алексей, он жил в своем замке совсем один, но ему не было одиноко,');
textout(10,240,'так как он был интровертом и ему нравилось быть одному в своем замке, но однажды в его мир');
textout(10,260,'попал куб, по имени Злодей. Злодей был интровертом, поэтому ему было одиноко жить одному в');
textout(10,280,'своем мире и он решил, с помощью портала попасть в мир шара, чтобы тот переехал к нему и');
textout(10,300,'они вместе смотрели воскрестные передачи, но Алексею это не нравилось, поэтому он решил');
textout(10,320,'уничтожить его портал, а убивать ли вам куб решаете вы (когда вы прыгаете, то урон куба ');
textout(10,340,'становится больше).');
textout(10,360,'Для перемещения нажимайте на стрелки: вправо, влево. Для прыжка нажимайте пробел');
textout(10,380,'для удара нажмите "z"');
textout(10,420,'чтобы начать игру нажмите  "q"');
textout(10,10,'автор: Атай Кыдыров Жумадилович');
 perv:=picture.Create('called.png');
 perv.Draw(50,100);

//блокирование рисования на графическом окне
lockdrawing;

// объявление процедуры событыя нажатия
OnkeyDown:=KeyDown;







// бесконечный цикл

while u<1 do begin
if eco=1 then begin
redraw;
 clearwindow;

hj2:=hj;
if end1=0 then begin
end2:=0;
if healthcastle>590 then begin
 end1:=2;
end;

if atakport=1 then begin
healthportal:=healthportal+3;
atakport:=0;
end;



//фон
 oz:=picture.Create('sky.png');
 oz.Draw(0,0);
 oz:=picture.Create('sky2.png');
 oz.Draw(ft,0);
 ft:=ft+1;
 if ft>640 then begin
 ft:=-600;
 end;


//рисунок земли
  kol:=picture.Create('ground1.png');
 kol.Draw(20,l-107);
   kol1:=picture.Create('ground2.png');
 kol1.Draw(0,l-17);
 
 
 //рисунок замка
    poi:=picture.Create('castle.png');
 poi.Draw(35,l-298);
 
 //рисунок портала
     poi1:=picture.Create('portal.png');
 poi1.Draw(500,l-160);
 
 //жизни
     poi4:=picture.Create('healthсircle.png');
 poi4.Draw(508,90);
     poi2:=picture.Create('healthportal.png');
 poi2.Draw(400,10);
      poi3:=picture.Create('healthcastle.png');
 poi3.Draw(400,50);
 
 
 
 if x>hj-50 then begin
evildosta:=1;
end;
 if x<hj+25 then begin
evildosta:=2;

end;
if opi=0 then begin

//рисунок врага
         evil:=picture.Create('evil.png');
evil.Draw(hj,l-102);
if more=0 then begin
end;

//жизни врага
         evilhealth:=picture.Create('evilhealth.png');
evilhealth.Draw(hj-10,l-142);
hj:=hj-1;


if (x<hj+125) and (x>hj-50) and (y<l-15) and (y>l-100) then begin

 hj:=hj+1;
 
if more=1 then begin
 healthevil:=healthevil+3;
end;
if evildosta=0 then begin

end;

//если вы будете достаточно близко и справо от врага, то он смотрит вправо
if evildosta=1 then begin
        evil:=picture.Create('evil2.png');
evil.Draw(hj,l-102);
         evilhand:=picture.Create('evilhand.png');
evilhand.Draw(hj-22,l-handevil);
         evilhand:=picture.Create('evilhand2.png');
evilhand.Draw(hj+72,l-handevil);

end;



//если вы будете достаточно близко и слево от врага, то он осмотрит влево
if evildosta=2 then begin
        evil:=picture.Create('evil3.png');
evil.Draw(hj,l-102);
         evilhand:=picture.Create('evilhand.png');
evilhand.Draw(hj-22,l-handevil);
         evilhand:=picture.Create('evilhand2.png');
evilhand.Draw(hj+72,l-handevil);

end;




if handevil<l-170 then begin

handevil:=handevil+1;
end;
if handevil>=l-170 then begin
handevil:=handevil-50;
end;
if handevil<l-200 then begin
 healthcircle:=healthcircle+3;
end;
if healthcircle>595 then begin
 end1:=2;
end;
end;

if hj=250 then begin
if x>210 then begin
 hj:=hj+1;
 
          evilhand:=picture.Create('evilhand.png');
evilhand.Draw(hj-22,l-handevil);
         evilhand:=picture.Create('evilhand2.png');
evilhand.Draw(hj+72,l-handevil);
 if handevil<l-170 then begin

handevil:=handevil+1;
end;

if handevil>=l-170 then begin
handevil:=handevil-50;
end;
if handevil<l-200 then begin
 healthCASTLE:=healthCASTLE+3;
end;
if healthcircle>595 then begin
 end1:=2;
end;
end;
if x<10 then begin
 hj:=hj+1;
 
          evilhand:=picture.Create('evilhand.png');
evilhand.Draw(hj-22,l-handevil);
         evilhand:=picture.Create('evilhand2.png');
evilhand.Draw(hj+72,l-handevil);
 if handevil<l-170 then begin

handevil:=handevil+1;
end;

if handevil>=l-170 then begin
handevil:=handevil-50;
end;
if handevil<l-200 then begin
 healthCASTLE:=healthCASTLE+3;
end;
if healthcircle>595 then begin
 end1:=2;
end;
end;
if (x<210) and (x>10) then begin

 hj:=hj+1;
 
          evilhand:=picture.Create('evilhand.png');
evilhand.Draw(hj-22,l-handevil3);
         evilhand:=picture.Create('evilhand2.png');
evilhand.Draw(hj+72,l-handevil3);
 if handevil3<l-170 then begin

handevil3:=handevil3+1;
end;

if handevil3>=l-200 then begin
handevil3:=handevil3-70;
end;
if handevil3<l-250 then begin
 healthCASTLE:=healthCASTLE+3;
end;
if healthcircle>595 then begin
 end1:=2;
end;

end;
end;
end;


//линия для полоски здоровья
  line(healthportal,10,healthportal,40);
  if opi=0 then begin
    line(healthevil+hj2-10,l-142,healthevil+hj2-10,l-112);
    end;
  line(healthcastle,50,healthcastle,80);
  line(healthcircle,90,healthcircle,120);
 floodfill(597,20,clRed);
 floodfill(597,60,clgreen);
if opi=0 then begin
 floodfill(hj+80,l-135,clpurple);
 end;
  floodfill(597,100,clyellow);
 healthcastle:=healthcastle+2;
 healthcastle2:=healthcastle2-1;
 healthportal2:=healthportal2-1;
 healthcircle2:=healthcircle2-1;
healthportal:=healthportal+2;
healthcircle:=healthcircle+2;


if healthevil+hj-10>hj+79 then begin
healthevil:=healthevil-2;
opi:=1;
end;
if healthcircle>healthcircle2 then begin
healthcircle:=healthcircle-2;
end;
if healthcastle>healthcastle2 then begin
healthcastle:=healthcastle-2;
end;
if healthportal>healthportal2 then begin
healthportal:=healthportal-2;
end;





if (y<l-91)and(y>l-140)and(x<10)and(x>210)then begin
 jd:=0;
 d:=0;
end;
if l>y+27 then begin
 jd:=0;
end;
if (y<l-141) and (x>10)and (x<210) then begin
j:=1;
jd:=0;

end;
if (y>l-142)and (x<210)and (x>10)  then begin
j:=0;
jd:=1;

end;


 if dosta=1 then begin
 x:=x-3;
 dosta:=0;
 if (x>10)and (x<210) and (y<l-7)and (y>l-117) then begin
 x:=x+3;
 end;


// стены, не позволяющие выходить за границы экрана (влево)
if x<5 then begin
x:=x+3;
end;



 end;
  if dosta=2 then begin
 x:=x+3;
 dosta:=0;
 if (x>10)and (x<210) and (y<l-7)and (y>l-117) then begin
 x:=x-3;
 end;
if x>629 then begin
 x:=x-3;
end;

 end;
 if (x<11)and (y+30<l) then begin

  d:=0;
    h:=h+1;
  y:=y-s+h;
  l:=l+s-h;
  if y+30>l then begin
  y:=y-2;
  l:=y+28;
  jd:=1;
 
  end;
  
 end;
 if (x>210)and (y+30<l)then begin
 
  d:=0;
  h:=h+1;
  y:=y-s+h;
  l:=l+s-h;
  if y+30>l then begin
  y:=y-2;
  l:=y+28;
  jd:=1;
 
  end;
 
 end;
  if (x>11)and (y+129=l) then begin

  d:=0;
    h:=h+1;
  y:=y-s+h;
  l:=l+s-h;
  if y+129>l then begin
  l:=l-1;
  y:=l-118;
  jd:=1;
 
  end;
  
 end;
 if (x>210)and (y+129=l)then begin
 
  d:=0;
  h:=h+1;
  y:=y-s+h;
  l:=l+s-h;
  if y+129>l then begin
  l:=l-1;
 y:=l-118;
 
  jd:=1;
 
  end;
 
 end;
   if (d=1) then begin

   s:=40;
   h:=26;
   y:=y-s+h-1;
   l:=l+s-h;

   
  end;

 if (j=1)and (y<l-90)and(y<l-90) and (x>10) and (x<210) then begin
  
  h:=h+1;
  y:=y-s+h;
  l:=l+s-h;
d:=0;


 end;


    //шар
    circle(x,y,10);
    floodfill(x,y,clYellow);


     // шар смотрит влево
            if dosta2=1 then begin

        line(x-5-2,y+3,x+5-2,y+3);
        line(x-3-2,y-1,x-3-2,y-5);
        line(x+3-2,y-1,x+3-2,y-5);
        if more=0 then begin
            circle(x+8,y+2,5);
         floodfill(x+8,y+2,clyellow);
         end;
        if more=1 then begin
         circle(x-15,y+2,5);
         floodfill(x-15,y+2,clyellow);
 
         end;
        end;
        
        // шар смотрит вправо
            if dosta2=2 then begin

        line(x-5+2,y+3,x+5+2,y+3);
        line(x-3+2,y-1,x-3+2,y-5);
        line(x+3+2,y-1,x+3+2,y-5);
        if more=0 then begin
            circle(x-8,y+2,5);
         floodfill(x-8,y+2,clyellow);
         end;
        if more=1 then begin
         circle(x+15,y+2,5);
         floodfill(x+15,y+2,clyellow);

         end;
        end;



  sleep(1);
  end;
  
  // выигрыш и проигрыш
  if end1=1 then begin

         poi3:=picture.Create('you win.png');
 poi3.Draw(200,100);
 
 end2:=1;
 textout (200,255,'нажмите enter, чтобы начать заново');
 onkeydown:=keydown;
 
  end;
    if end1=2 then begin
   clearwindow;
        youwin:=picture.Create('you lose.png');
 youwin.Draw(200,100);
  end2:=1;
   textout (210,260,'нажмите enter, чтобы начать заново');
   onkeydown:=keydown;
  end;
    if end1=3 then begin
   clearwindow;
         youlose:=picture.Create('you lose.png');
 youlose.Draw(200,100);
  end2:=1;
  textout (210,260,'нажмите enter, чтобы начать заново');

  onkeydown:=keydown;
  end;
 end;
 end;
 // конец программы
END.