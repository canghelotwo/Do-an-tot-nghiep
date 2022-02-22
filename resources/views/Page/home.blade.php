@extends('layout')
@section('content')
@if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
   @endif
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   
   <h2 style="font-weight: 400;">Trang Chủ</h2>
</div>
<div class="n-post pt-3">
   <hr>
   <h3 class="n-post__title"><span>NHỮNG ĐIỀU CẦN BIẾT KHI TIÊM PHÒNG CHO BÉ</span></h3>
   <hr>
   <div class="n-post__detail">
      <p style="text-align: justify;">Tiêm phòng vắc-xin cho bé sơ sinh sẽ kích thích sự phát triển của hệ thống miễn dịch của trẻ, giúp ngăn ngừa và hạn chế khả năng lây nhiễm của nhiều tác nhân gây bệnh.</p>
      <h4 style="text-align: justify;"><strong>VÌ SAO CẦN TIÊM PHÒNG CHO BÉ</strong></h4>
      <p style="text-align: justify;">Tiêm phòng vắc-xin cho bé sơ sinh sẽ kích thích sự phát triển của hệ thống miễn dịch của bé, giúp ngăn ngừa và hạn chế khả năng lây nhiễm của nhiều tác nhân gây bệnh. Theo các chuyên gia,&nbsp;so với một số tác dụng phụ không mong muốn, mức độ rủi ro khi bé không được tiêm chủng vượt xa rất nhiều lần. Vì thế, tiêm phòng là cách đơn giản và hiệu quả nhất bảo vệ bé cưng khỏi&nbsp;nguy cơ tử vong, tàn tật và những biến chứng nguy hiểm của nhiều loại bệnh “đáng sợ”.</p>
      <p style="text-align: justify;"><img class="aligncenter wp-image-1710" title="Mẹ nhớ dẫn bé tiêm phòng đúng lịch để ngừa bệnh cho bé nhé" src="https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_350223170_supersize.jpg" alt="Mẹ nhớ dẫn bé tiêm phòng đúng lịch để ngừa bệnh cho bé nhé" width="700" height="426" srcset="https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_350223170_supersize.jpg 4500w, https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_350223170_supersize-422x257.jpg 422w" sizes="(max-width: 700px) 100vw, 700px"></p>
      <p style="text-align: center;"><em>Mẹ nhớ dẫn bé tiêm phòng đúng lịch để ngừa bệnh cho bé nhé</em></p>
      <h4 style="text-align: justify;"><strong>NHỮNG MŨI TIÊM CẦN THIẾT CHO BÉ THEO ĐỘ TUỔI</strong></h4>
      <p style="text-align: justify;"><em>Sơ sinh:</em></p>
      <ul style="text-align: justify;">
         <li>Tiêm vac xin Viêm gan B( VGB) phòng bệnh viêm gan B: càng sớm càng tốt(trong 24 h đầu sau sinh)</li>
         <li>Tiêm vac xin BCG phòng bệnh lao: càng sớm càng tốt</li>
      </ul>
      <p style="text-align: justify;"><em>2- 6 tháng tuổi:</em></p>
      <ul style="text-align: justify;">
         <li>Tiêm vac xin Bạch hầu- Ho gà- Uốn ván-Viêm gan B- Hib mũi 1 + uống vac xin Bại liệt lần 1 : khi trẻ 2 tháng tuổi</li>
         <li>Tiêm vắc xin Bạch hầu- Ho gà- Uốn ván-Viêm gan B- Hib mũi 2 + uống vac xin Bại liệt lần 2 : khi trẻ 3 tháng tuổi</li>
         <li>Tiêm vac xin Bạch hầu- Ho gà- Uốn ván-Viêm gan B- Hib mũi 3 + uống vac xin Bại liệt lần 3 : khi trẻ 4 tháng tuổi</li>
         <li>Vắc-xin Rotavirut: ngăn ngừa Rota virut gây bệnh tiêu chảy</li>
      </ul>
      <p style="text-align: justify;"><em>6-12 tháng tuổi:</em></p>
      <ul style="text-align: justify;">
         <li>Tiêm phòng cúm</li>
         <li>Tiêm vac xin sởi: khi trẻ 9 tháng tuổi.</li>
      </ul>
      <p style="text-align: justify;"><em>18 tháng tuổi:</em></p>
      <ul style="text-align: justify;">
         <li>Vắc xin&nbsp; tiêm nhắc Bạch hầu – Ho gà- Uốn ván ; viêm gan B</li>
         <li>Tiêm vac xin sởi mũi 2</li>
      </ul>
      <p style="text-align: justify;"><em>1-5 &nbsp;tuổi:</em></p>
      <ul style="text-align: justify;">
         <li>Tiêm vac xin viêm não nhật bản phòng bệnh viên não nhật bản:</li>
      </ul>
      <p style="text-align: justify;">Mũi 1: &nbsp;khi trẻ 1 tuổi</p>
      <p style="text-align: justify;">&nbsp;Mũi 2: 2 tuần sau mũi 1</p>
      <p style="text-align: justify;">Mũi 3:&nbsp; 1 năm sau mũi 2</p>
      <ul style="text-align: justify;">
         <li>Tiêm vắc xin phối hợp Sởi- Quai bị -Rubella:</li>
      </ul>
      <p style="text-align: justify;">Mũi 1 : khi trẻ 13-15 tháng tuổi</p>
      <p style="text-align: justify;">Mũi 2: khi trẻ 4-6 tuổi.</p>
      <ul style="text-align: justify;">
         <li>Tiêm vắc xin phòng Thủy đậu: khi trẻ trên 12 tháng tuổi.</li>
         <li>Tiêm phòng não mô cầu AC : khi trẻ từ 2 tuổi trở lên.</li>
      </ul>
      <ul style="text-align: justify;">
         <li>&nbsp;Vac xin tả phòng bệnh tả: Cho trẻ uống 2 liều khi trẻ từ 2-5 tuổi ( lần 2 sau lần một 2 tuần)</li>
      </ul>
      <p style="text-align: justify;"><img class="aligncenter wp-image-1704" title="Lưu ý khi tiêm phòng cho bé" src="https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_395392888_huge.jpg" alt="Lưu ý khi tiêm phòng cho bé" width="700" height="466" srcset="https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_395392888_huge.jpg 2500w, https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_395392888_huge-270x180.jpg 270w, https://www.vinamilk.com.vn/sua-bot-vinamilk/wp-content/uploads/2016/07/shutterstock_395392888_huge-422x281.jpg 422w" sizes="(max-width: 700px) 100vw, 700px"></p>
      <h4 style="text-align: justify;"><strong>LƯU Ý KHI TIÊM PHÒNG CHO BÉ</strong></h4>
      <p style="text-align: justify;">– Không nên cho bé ăn quá no hoặc quá đói trước khi tiêm phòng.</p>
      <p style="text-align: justify;">– Vệ sinh cá nhân sạch sẽ để hạn chế nguy cơ nhiễm trùng</p>
      <p style="text-align: justify;">– Mang theo sổ khám bệnh và thông báo trước cho nhân viên y tế về tình trạng sức khỏe cũng như các bệnh mãn tính của bé,&nbsp;dị tật bẩm sinh, tiền sử dị ứng, nhất là phản ứng của bé với những lần tiêm phòng khác.</p>
      <p style="text-align: justify;">– Các loại vắc-xin sống như lao, sởi, thủy đậu… nên tiêm phòng cách nhau ít nhất 4 tuần</p>
      <p style="text-align: justify;">– Ngoài những đợt tiêm phòng cần thiết cho bé theo độ tuổi, bạn vẫn có thể&nbsp; cho bé đi tiêm phòng trong các trường hợp sau:</p>
      <ul style="text-align: justify;">
         <li>Bé bị đau, đỏ hay sưng ở vị trí tiêm phòng sau lần tiêm phòng Ho gà – Bạch hầu – Uốn ván trước. hoặc bị sốt dưới 40,5 độ sau lần tiêm phòng Ho gà – Bạch hầu – Uốn ván trước.</li>
         <li>Bé đang mắc bệnh nhẹ như cảm lạnh, ho hoặc tiêu chảy nhẹ mà không sốt.</li>
         <li>Bé đang hồi phục từ một bệnh nhẹ như cảm lạnh, ho, hay tiêu chảy.</li>
         <li>Bé bị suy dinh dưỡng</li>
         <li>Bé đang mọc răng</li>
         <li>Gia đình có tiền sử co giật hay mắc Hội chứng đột tử nhũ nhi.</li>
      </ul>
      <p style="text-align: justify;">– Nên hoãn tiêm phòng cho bé trong các trường hợp sau:</p>
      <ul style="text-align: justify;">
         <li>Trẻ đang sốt, đang mắc bệnh nhiễm khuẩn cấp tính như viêm phổi, thương hàn, tiêu chảy, sởi…</li>
         <li>Trẻ mới khỏi bệnh các bệnh trên và đang trong thời kỳ hồi sức,</li>
         <li>Trẻ đang bị bệnh ngoài da, có mủ hoặc bệnh chàm ngoài da (Eczema).</li>
         <li>Trẻ đang mắc bệnh mãn tính đang tiến triển như lao phổi, bệnh thận …</li>
      </ul>
      <p style="text-align: justify;">Tiêm phòng cho bé cần đúng thời điểm lứa tuổi và các loại vacxin phù hợp. Để đạt được kết quả tốt nhất nên nghe theo sự chỉ dẫn của bác sĩ. Mẹ hãy tham khảo để biết trước những điều cần làm tốt nhất cho bé nhé!</p>
      <p style="text-align: right;"><strong>Bác sỹ Hồ Thị Nam Huế</strong></p>
      <p style="text-align: right;"><strong>Trung tâm Dinh dưỡng VNM</strong></p>
   </div>
</div>
@endsection