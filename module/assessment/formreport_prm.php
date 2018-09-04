<?php
	include("../../function/db_function.php");
	$con=connect_db();
?>

<form class="p-2"> 
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm pt-2">
			<h5>แบบรายงานผลการปฏิบัติงาน ของบุคลากรสายวิชาการ</h5>
		</div>
		<div class="col-sm-2 text-center pt-2" style="border:solid 1px;">
			<p>สายวิชาการ (ทุกราย)</p>
		</div>
	</div>
	<br>
	<div class="row text-center">
		<div class="col-md-2"></div>
		<div class="col-md">
			<div class="form-group row">
				<label  class="col-sm-1 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>
				<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm pt-2 text-center">
			<p>สังกัด คณะบริหารธุรกิจและศิลปศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</p>
		</div>
		<div class="col-sm-2"></div>
	</div>
	
	<div class="row">
		<div class="col-md-2"></div>
			<div class="col-md row text-center"> <!-- รอบที่ -->
				<div class="form-check col-md-1">
					<input type="checkbox"  class="form-check-input" id="" value="">
				</div>
				<div class="form-group row col-md">
					<label for="inputState" class="col-md">รอบที่ 1  ต.ค  </label>
					<div class="col-md">
						<select id="inputState" class="form-control ">
							<option selected>2561</option>
							<option>2562</option>
						</select>
					</div>
				</div>
				<div class="form-group row col-md">
					<label for="inputState" class="col-md"> -  31 มี.ค </label>
					<div class="col-md">
						<select id="inputState" class="form-control">
							<option selected>2561</option>
							<option>2562</option>
						</select>
					</div>
					<label for="inputState" class="col-md-1"> )</label>
				</div>
			</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row">
		<div class="col-md-2"></div>
			<div class="col-md row text-center"> <!-- รอบที่ -->
				<div class="form-check col-md-1">
					<input type="checkbox"  class="form-check-input" id="" value="">
				</div>
				<div class="form-group row col-md">
					<label for="inputState" class="col-md">รอบที่ 2  เม.ย  </label>
					<div class="col-md">
						<select id="inputState" class="form-control ">
							<option selected>2561</option>
							<option>2562</option>
						</select>
					</div>
				</div>
				<div class="form-group row col-md">
					<label for="inputState" class="col-md"> -  30 ก.ย  </label>
					<div class="col-md">
						<select id="inputState" class="form-control">
							<option selected>2561</option>
							<option>2562</option>
						</select>
					</div>
					<label for="inputState" class="col-md-1"> )</label>
				</div>
			</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row">
		<div class="col-md">
			<table class="table table-bordered">
				<thead class="thead-light">
					<tr>
						<th>ลำดับ</th>
						<th>องค์ประกอบที่ใช้ประเมิน</th>
						<th>ภาระงาน/กิจกรรม/โครงงาน/งาน</th>
						<th>จำนวน(หน่วยชม./งาน/กิจกรรม)</th>
						<th>หลักฐาน  ร่อยรอย การปฏิบัติงาน</th>
						<th>ระดับคะแนนที่ได้</th>
					</tr>
				</thead>
				<tbody>
					<!-- 1.  งานสอน  -->
					<tr>
						<td rowspan="7">1</td>
						<td >1.  งานสอน     </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  1.1 การสอนภาคทฤษฏีระดับปริญญาตรี/โท....การสอนภาคปฏิบัติปริญญาตรี/โท.....</td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan="6"></td>
					</tr>
					<tr>
						<td >  1.2 การนิเทศนักศึกษา/สหกิจศึกษา/นักศึกษาฝึกสอน</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  1.3 การเป็นที่ปรึกษาวิชาปัญหาพิเศษ โครงการ/โครงงาน วิทยานิพนธ์ การศึกษาเฉพาะเรื่อง/สารนิพนธ์/การค้นคว้าอิสระ/ปริญญานิพนธ์</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  1.3 การเป็นที่ปรึกษาวิชาปัญหาพิเศษ โครงการ/โครงงาน วิทยานิพนธ์ การศึกษาเฉพาะเรื่อง/สารนิพนธ์/การค้นคว้าอิสระ/ปริญญานิพนธ์</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>	
					<tr>
						<td >      1.5 การจัดการเรียนการสอนโดยวิธีอื่น ๆ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td colspan="2" class="text-center"> รวม  </td>
						<td></td>
						<td></td>
					</tr>
					<!-- END 1.  งานสอน  -->
					<!--  2.  งานที่ปรากฏเป็น  ผลงานทางวิชาการตามหลักเกณฑ์ที่ก.พ.อ.กำหนด  -->
					<tr>
						<td rowspan="6">2</td>
						<td >2.  งานที่ปรากฏเป็น  ผลงานทางวิชาการตามหลักเกณฑ์ที่ก.พ.อ.กำหนด          </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  2.1 งานวิจัยหรืองานสร้างสรรค์</td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan="5"></td>
					</tr>
					<tr>
						<td >  2.2 การเรียบเรียงตำรา หรือ หนังสือ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  2.3 บทความวิชาการ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  2.4 ผลงานวิชาการในลักษณะอื่น</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>	

					<tr>
						<td colspan="2" class="text-center"> รวม  </td>
						<td></td>
						<td></td>
					</tr>
					<!-- END  2.  งานที่ปรากฏเป็น  ผลงานทางวิชาการตามหลักเกณฑ์ที่ก.พ.อ.กำหนด  -->
					<tr>
						<td rowspan="7">3</td>
						<td >3. งานบริการทางวิชาการ     </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  3.1 การเป็นอาจารย์พิเศษ/วิทยากร ภายในหรือภายนอกมหาวิทยาลัย</td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan="6"></td>
					</tr>
					<tr>
						<td >  3.2 การจัดประชุม สัมมนาฝึกอบรมและจัดนิทรรศการ แก่หน่วยงานภายนอก</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >   3.3 เป็นที่ปรึกษาโครงการวิจัย/วิทยานิพนธ์/เมธีวิจัย/ผู้เชี่ยวชาญ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  3.4 การรับงานที่มีรายได้เข้ามหาวิทยาลัยฯ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>	
					<tr>
						<td >  3.5 การให้บริการทางวิชาการในฐานะเป็นผู้เชี่ยวชาญ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td colspan="2" class="text-center"> รวม  </td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td rowspan="4">4</td>
						<td >4.  งานทำนุบำรุงศิลป วัฒนธรรมและอนุรักษ์สิ่งแวดล้อม</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td > 4.1 การจัดโครงการหรือกิจกรรมทำนุบำรุงศิลป วัฒนธรรมและอนุรักษ์สิ่งแวดล้อม</td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan="3"></td>
					</tr>
					<tr>
						<td >  4.2 เข้าร่วมโครงการหรือกิจกรรมทำนุบำรุงศิลป วัฒนธรรมและอนุรักษ์สิ่งแวดล้อม</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
					<tr>
						<td colspan="2" class="text-center"> รวม  </td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td rowspan="5">5</td>
						<td >5.  งานพัฒนานักศึกษา งานที่ได้รับการแต่งตั้งให้ดำรงตำแหน่งและงานที่ได้รับมอบหมายอื่น ๆ </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >  5.1 การเป็นอาจารย์ ที่ปรึกษา</td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan="4"></td>
					</tr>
					<tr>
						<td >  5.2 การปฏิบัติงานที่ได้รับการแต่งตั้งให้ดำรงตำแหน่ง</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td >   5.3 การปฏิบัติหน้าที่ ที่ได้รับมอบหมายอื่น ๆ</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
					<tr>
						<td colspan="2" class="text-center"> รวม  </td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="2" class="text-center"> รวมภาระงานทั้งสิ้น  </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>									
				</tbody>
			</table>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm text-center">ข้าพเจ้าขอรับรองว่าได้ปฏิบัติงานตามที่รายงานผลการปฏิบัติงานจริง  หากต่อมาภายหลังตรวจสอบแล้วว่าไม่เป็นความจริง  ข้าพเจ้าจะเป็นผู้รับผิดชอบ
		ทุกประการ
		</div>
   	</div>
   	<br>
   	<div class="row">
		<div class="col-sm-6"></div>
		<div class="col-sm text-center">
			<p>ลงชื่อผู้รายงานผลปฏิบัติงาน</p>
			<p></p>
			<p>(              )</p>
			<p>วันที่ เดือน  พ.ศ. </p>
		</div>
		<div class="col-sm-1"></div>
   	</div>

   	<div class="row">
   		<div class="col-sm text-center">
			<p>   ผู้บังคับบัญชาได้พิจารณาแล้วให้การรับรอง</p>
			<p>ลงชื่อ </p>
			<p>(              )</p>
			<p> ตำแหน่ง </p>
			<p>วันที่ เดือน  พ.ศ. </p>
		</div>
		<div class="col-sm-6"></div>
   	</div>
	
	
</form>


<?php
	mysqli_close($con);
?>