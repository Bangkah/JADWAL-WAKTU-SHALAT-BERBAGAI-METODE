<?php
	//
?>
<head>
	<title> Jadwal Waktu Shalat Bulanan </title>
    	<style>
    		body, tr, form {font-family: tahoma; font-size: 20px; color: #404040; text-align: center; margin: 0; padding: 0}
    		pre {font-family: courier, serif, size: 10pt; margin: 0px 8px;}
    		input {font-size: 16px;}
    		.header {background:#eef; border-bottom: 1px solid #ddd; padding: 15px;}
    		.caption {font-size: 20px; color: #d95722; text-align: center; width: 10em;}
    		.arrow {font-weight: bold; text-decoration: none; color: #3D3D3D; }
    		.arrow:hover {text-decoration: underline;}
    		.command {font-weight: bold; text-decoration: none; color: #AAAAAA; }
    		.command:hover {text-decoration: underline;}
    		.timetable {border-width: 1px; border-style: outset; border-collapse: collapse; border-color: gray; margin: 0 auto;}
    		.timetable td {border-width: 1px; border-spacing: 1px; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px; border-style: inset; border-color: #CCCCCC; }
    		.head-row {color: #d90036; background-color: #bfefff;}
    		.today-row {background-color: #ffefbf; color: #d90036}
            <style>
        /* Reset & font */
        body, tr, form { font-family: 'Tahoma', sans-serif; font-size: 18px; color: #333; margin: 0; padding: 0; text-align: center; background-color: #f8fafc; }
        input, select { font-size: 16px; padding: 4px 6px; border: 1px solid #ccc; border-radius: 4px; }
        hr { border-color: #ffb6b9; margin: 15px 0; }

        /* Header */
        .header { background: #e0f7fa; border-bottom: 1px solid #ccc; padding: 15px; border-radius: 8px; margin-bottom: 10px; }
        .caption { font-size: 20px; color: #d95722; text-align: center; width: 10em; font-weight: bold; }
        .arrow { font-weight: bold; text-decoration: none; color: #3D3D3D; font-size: 20px; margin: 0 10px; }
        .arrow:hover { text-decoration: underline; }

        /* Table timetable */
        .timetable { border-collapse: collapse; border-radius: 8px; overflow: hidden; margin: 0 auto; width: 80%; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .timetable td { padding: 10px 15px; border-bottom: 1px solid #ddd; }
        .timetable tr.head-row { background-color: #4fc3f7; color: #fff; font-weight: bold; }
        .timetable tr.today-row { background-color: #ffe082; color: #d84315; font-weight: bold; }

        /* Form style */
        .form { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-top: 10px; }
        .form span { margin-right: 5px; }
        .form select, .form input { min-width: 80px; }

        /* Info box */
        fieldset { border: 1px solid #ccc; border-radius: 8px; padding: 15px; background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .info { font-size: 14px; color: #555; line-height: 1.6; margin: 10px 0; }

        /* Footer links */
        .links { font-size: 14px; margin-top: 10px; }
        .links a { color: #0288d1; text-decoration: none; margin: 0 5px; }
        .links a:hover { text-decoration: underline; }
    	</style>	
    	<style>
        	hr{
       	    	border-color: pink;
       		}
    	</style>    
    	<script type="text/javascript">

		var iTanggalM = 0;
		var iTanggalH = 0;
		var iBulanM = 0;
		var iBulanH = 0;
		var iTahunM = 0;
		var iTahunH = 0;
		var iTahunJ = 0;

		function intPart(floatNum) {
			return(floatNum<-0.0000001? Math.ceil(floatNum-0.0000001) : Math.floor(floatNum+0.0000001));
		}

		function hitung_Hijriah(d,m,y) {
			mPart = (m-13)/12;
			jd = intPart((1461*(y+4800+intPart(mPart)))/4)+
			intPart((367*(m-1-12*(intPart(mPart))))/12)-
			intPart((3*(intPart((y+4900+intPart(mPart))/100)))/4)+d-32075;
			l = jd-1948440+10632;
			n = intPart((l-1)/10631);
			l = l-10631*n+354;
			j = (intPart((10985-l)/5316))*(intPart((50*l)/17719))+(intPart(l/5670))*(intPart((43*l)/15238));
			l = l-(intPart((30-j)/15))*(intPart((17719*j)/50))-(intPart(j/16))*(intPart((15238*j)/43))+29;
			iBulanH = intPart((24*l)/709);
			iTanggalH = l-intPart((709*iBulanH)/24);
			
			tambahan = 1;  // Tambahan adalah angká penyesuaian, biasanya -1,0,+1
			
			iTanggalH = iTanggalH + tambahan;
			iTahunH = 30*n+j-30;
			iBulanH -= 1;
		}

 

		function hitung_Tanggal(format) {
			var namaBulanE = new Array( "January","February","March","April","May","June","July","August","September","October","November","December");
			var namaBulanH = new Array( "Muharram","Safar","Rabi Al-Awwal","Rabi Al-Thani","Jumada Al-Ula","Jumada Al-Thani","Rajab","Shaban","Ramadan","Shawwal","Dhul Qada","Dhul Hijja");
			var namaBulanI = new Array( "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			var namaBulanHI = new Array( "Muharram","Safar","Rabi'ul Awal","Rabi'ul Akhir","Jumadil Awal","Jumadil Akhir","Rajab","Sya'ban","Ramadhan","Syawal","Dzul Qa'dah","Dzul Hijjah");
			var namaBulanJ = new Array( "Suro","Sapar","Mulud","Ba'da Mulud","Jumadil Awal","Jumadil Akhir","Rejeb","Ruwah","Poso","Syawal","Dulkaidah","Besar");
			var namaHariE = new Array("Thursday","Friday","Saturday","Sunday","Monday","Tuesday","Wednesday");
			var namaHariH = new Array("Al-Hamis","Al-Jum'a","As-Sabt","Al-Ahad","Al-Itsnayna","Ats-Tsalatsa'","Al-Arba'a'");
			var namaHariI = new Array("Kamis","Jumat","Sabtu","Ahad","Senin","Selasa","Rabu");
			var namaHariJ = new Array("Wage","Kliwon","Legi","Pahing","Pon","Wage","Kliwon");

			now = new Date(); 
			iTanggalM = now.getDate();
			iBulanM = now.getMonth();
			iTahunM = now.getYear();
			if(iTahunM<1900) { iTahunM += 1900 }; // Y2K
			
			hitung_Hijriah(iTanggalM,iBulanM,iTahunM);
			hr = Date.UTC(iTahunM,iBulanM,iTanggalM,0,0,0)/1000/60/60/24;
			
			iTahunJ = iTahunH+512;
			sHariE = namaHariE[hr%7];         //string nama hari : Inggris
			sHariH = "Yaum "+namaHariH[hr%7]; //string nama hari : Arab
			sHariI = namaHariI[hr%7];         //string nama hari : Indonesia
			sHariJ = namaHariJ[hr%5];         //string nama hari : Jawa (hari pasar)
			sBulanE = namaBulanE[iBulanM];    //string nama bulan : Masehi - Inggris
			sBulanH = namaBulanH[iBulanH];    //string nama bulan : Hijriah - Arab
			sBulanI = namaBulanI[iBulanM];    //string nama bulan : Masehi - Indonesia
			sBulanHI = namaBulanHI[iBulanH];  //string nama bulan : Hijriah - Indonesia
			sBulanJ = namaBulanJ[iBulanH];    //string nama bulan : Hijriah - Jawa

			//iTanggalM : int tanggal Masehi (Inggris/Indonesia)
			//iTanggalH : int tanggal Hijriah (Arab/Indonesia/Jawa)
			
			zTanggalM = iTanggalM<10? "0"+iTanggalM : iTanggalM; //int tanggal Masehi (Inggris/Indonesia), + leading zero
			zTanggalH = iTanggalH<10? "0"+iTanggalH : iTanggalH; //int tanggal Hijriah (Arab/Indonesia/Jawa), + leading zero
			iBulanM += 1; //int bulan Masehi (Inggris/Indonesia)
			iBulanH += 1; //int bulan Hijriah (Arab/Indonesia/Jawa)
			zBulanM = iBulanM<10? "0"+iBulanM : iBulanM; //int bulan Masehi (Inggris/Indonesia), + leading zero
			zBulanH = iBulanH<10? "0"+iBulanH : iBulanH; //int bulan Hijriah (Arab/Indonesia/Jawa), + leading zero

			//iTahunM : int tahun Masehi (Inggris/Indonesia)
			//iTahunH : int tahun Hijriah (Arab/Indonesia)
			//iTahunJ : int tahun Jawa
			//FORMAT :
			//1 (default) (Indonesia)              : Selasa, 1 Januari 1980
			//2           (English)                : Tuesday, 1 January 1980
			//3           (Indonesia + hari pasar) : Selasa Legi, 1 Januari 1980
			//4           (Jawa)                   : Selasa Legi, 12 Sapar 1912
			//5           (Arab/Hijriah)           : Yaum Ats-Tsalatsa, 12 Safar 1400 H
			//6           (Indonesia/Hijriah)      : Selasa, 12 Safar 1400 H
			//7           (English + Jawa :P)      : Tuesday Legi, 12 Sapar 1912
			//de-el-el?                          : masih banyak variasi? :D :D :D

			switch(format) {
				case 2 : { sDate = sHariE+", "+iTanggalM+" "+sBulanE+" "+iTahunM;break; }
				case 3 : { sDate = sHariI+" "+sHariJ+", "+iTanggalM+" "+sBulanI+" "+iTahunM;break; }
				case 4 : { sDate = sHariI+" "+sHariJ+", "+iTanggalH+" "+sBulanJ+" "+iTahunJ;break; }
				case 5 : { sDate = sHariH+", "+iTanggalH+" "+sBulanH+" "+iTahunH+" H";break; }
				case 6 : { sDate = sHariI+", "+iTanggalH+" "+sBulanHI+" "+iTahunH+" H";break; }
				case 7 : { sDate = sHariI+" "+sHariJ+", "+iTanggalM+" "+sBulanI+" "+iTahunM+" / "+iTanggalH+" "+sBulanHI+" "+iTahunH+" H / "+iTanggalH+" "+sBulanJ+" "+iTahunJ+" J";break; }
				case 8 : { sDate = sHariE+" "+sHariJ+", "+iTanggalH+" "+sBulanJ+" "+iTahunJ;break; }
				default : { sDate = sHariI+" "+sHariJ+", "+iTanggalM+" "+sBulanI+" "+iTahunM;break; }
			}
			return(sDate);
		}

		function tulis_Tanggal(format) {
			sDate = hitung_Tanggal(format);
			document.write(sDate);
		}
	</script>	
    	<script type="text/javascript" src="PrayTimes.js"></script>
</head>

<body>
<center>	
    <div align="center">
        <table align="center">
            <tr>
                <td border="0" align="center">
                <center>
                    <span style="font-size:14px; color: black;">
                    <script type="text/javascript">tulis_Tanggal(7);</script>
                    </span>
                    <a href="https://time.is/Semarang" id="time_is_link" rel="nofollow"></a>
                    <span style="font-size:14px; color: black;">&nbsp;&nbsp;-&nbsp;&nbsp;</span>
                    <span id="Semarang_z41c" style="font-size:14px; color: black;"></span>
                    <script src="//widget.time.is/t.js" type="text/javascript"></script>
                    <script type="text/javascript">time_is_widget.init({Semarang_z41c:{}});</script>
                    <span style="font-size:14px; color: black;">&nbsp;&nbsp;WIB</span>
                </center>
                </td>
            </tr>
        </table>
    </div>    
</center> 
	
<div align="center" style="margin-top: 7px">
    <table>
	    <tr>
            <td  align="justify">
                <fieldset>
                    <table border="0" align="center" class="a">
                        <tr>
                            <td align="justify">
                                <?php
                                    date_default_timezone_set("Asia/Jakarta");
                        	        $harini = date("d/M/Y - H:i:s A");
                        
                                    echo "<b>Posisi Matahari: ".$harini."</b><br/>";
                                    $wektu=date("Y-M-d");
                                    $sun_info = date_sun_info(strtotime($wektu), -7.06, 110.4);
                                    foreach ($sun_info as $key => $val) {
                                        echo "<font color='red'>$key:</font> " . date("H:i:s", $val) . "; \n";
                                    }
                                ?>     
                                <br/><br/>
                                Melalui data di atas, maka dapat ditentukan beberapa hal: <b>1) data sunrise</b> = Terbit matahari, <b>2) data sunset + waktu ikhtiyat 3 menit</b> = waktu Maghrib, <b>3) data transit + waktu ikhtiyat 3 menit</b> = waktu Dhuhur, <b>4) data astronomical twilight begin</b> = waktu Shubuh, <b>5) data astronomical twilight end + waktu ikhtiyat 3 menit</b> = waktu Isya.            
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>  
	    
        <tr>
            <td align="center">
                <hr/>
                <font color="brown" size="4">JADWAL WAKTU SHALAT BERBAGAI METODE</font>
                <hr/>
                    <div class="header">
                    <span style="font-size: 16px; color: blue;">Masukkan posisi Lintang (latitude) dan Bujur (longitude) tempat Anda: <br/></span>
                    <form class="form" action="javascript:update();">
                    	<span style="font-size: 16px;">Latitude:</span> <input type="text" value="-7.07" id="latitude" size="2" onchange="update();" />&nbsp;
                    	<span style="font-size: 16px;">Longitude:</span> <input type="text" value="110.4" id="longitude" size="2" onchange="update();" />&nbsp;<br/>
                    	<span style="font-size: 16px;">Time Zone:</span> <input type="text" value="7" id="timezone" size="2" onchange="update();" />&nbsp;
                    	<span style="font-size: 16px;">DST:</span> 
                    	<select id="dst" size="1" style="font-size: 16px;" onchange="update()">
                    		<option value="auto" selected="selected">Auto</option>
                    		<option value="0">0</option>
                    		<option value="1">1</option>
                        </select>&nbsp;<br/>
                        
                    	<span style="font-size: 16px;">Metode:</span> 
                    	<select id="method" size="1" style="font-size: 16px;" onchange="update()">
                    		<option value="DepagRI">Depag RI</option>
                    		<option value="ISRN">ISRN</option>
                    		<option value="MU" selected="selected">Muhammadiyah</option>
                    		<option value="MWL">Muslim World League (MWL)</option>
                    		<option value="ISNA">Islamic Society of North America (ISNA)</option>
                    		<option value="Egypt">Egyptian General Authority of Survey</option>
                    		<option value="Makkah">Umm al-Qura University, Makkah</option>
                    		<option value="Karachi">University of Islamic Sciences, Karachi</option>
                    		<option value="Jafari">Shia Ithna-Ashari (Jafari)</option>
                    		<option value="Tehran">Institute of Geophysics, University of Tehran</option>
                        </select> 
                    </form>
                    </div>
                    
                    <span style="font-size: 14px;"><b><font color="red" size="3">Catatan:</font></b> <br/>
                    <span style="font-size: 16px; color: blue;">Default Waktu Shubuh Menurut PP. Muhammadiyah</span>
                    <br/><br/>
                    Waktu Shubuh dan Isya ISRN ditentukan menurut data empirik Tim - ISRN-UHAMKA Jakarta, Shubuh: -13,2&deg; Isya: -13,0&deg;.
                    <br/> Sedangkan waktu Shubuh Muhammadiyah menggunakan keputusan parameter baru yaitu 18&deg;, bukan lagi 20&deg;.</span><hr/>
                    <table align="center">
                        <tr>
                        	<td><a href="javascript:displayMonth(-1)" class="arrow">&lt;&lt;</a></td>
                        	<td id="table-title" class="caption"></td>
                        	<td><a href="javascript:displayMonth(+1)" class="arrow">&gt;&gt;</a></td>
                        </tr>
                    </table>
                    
                    <table width="80%" id="timetable" class="timetable">
                    	<tbody></tbody>
                    </table>
                    
                    <div align="center" style="margin-top: 7px">
                        <span style="font-size: 14px;">Time Format: <a id="time-format" href="javascript:switchFormat(1)" title="Change clock format" class="command"></a>
                    	</span>
                    </div>
            </td>
        </tr>
    </table>
</div>
<hr/> <br/>

<script type="text/javascript">

	var currentDate = new Date();
	var timeFormat = 1; 
	switchFormat(0);

	// display monthly timetable
	function displayMonth(offset) {
		var lat = $('latitude').value;
		var lng = $('longitude').value;
		var timeZone = $('timezone').value;
		var dst = $('dst').value;
		var method = $('method').value;

		prayTimes.setMethod(method);
		currentDate.setMonth(currentDate.getMonth()+ 1* offset);
		var month = currentDate.getMonth();
		var year = currentDate.getFullYear();
		var title = monthFullName(month)+ ' '+ year;
		$('table-title').innerHTML = title;
		makeTable(year, month, lat, lng, timeZone, dst);
	}

	// make monthly timetable
	function makeTable(year, month, lat, lng, timeZone, dst) {		
	var items = {day: 'Tanggal', fajr: 'Shubuh', sunrise: 'Terbit', 
					dhuhr: 'Dhuhur', asr: 'Ashar', sunset: 'Sunset', 
					maghrib: 'Maghrib', isha: 'Isya'};
				
		var tbody = document.createElement('tbody');
		tbody.appendChild(makeTableRow(items, items, 'head-row'));

		var date = new Date(year, month, 1);
		var endDate = new Date(year, month+ 1, 1);
		var format = timeFormat ?  '24h' : '12hNS';

		while (date < endDate) {
			var times = prayTimes.getTimes(date, [lat, lng], timeZone, dst, format);
			times.day = date.getDate();
			var today = new Date(); 
			var isToday = (date.getMonth() == today.getMonth()) && (date.getDate() == today.getDate());
			var klass = isToday ? 'today-row' : '';
			tbody.appendChild(makeTableRow(times, items, klass));
			date.setDate(date.getDate()+ 1);  // next day
		}
		removeAllChild($('timetable'));
		$('timetable').appendChild(tbody);
	}

	// make a table row
	function makeTableRow(data, items, klass) {
		var row = document.createElement('tr');
		for (var i in items) {
			var cell = document.createElement('td');
			cell.innerHTML = data[i];
			cell.style.width = i=='day' ? '2.5em' : '3.7em';
			row.appendChild(cell);
		}
		row.className = klass;
		return row;		
	}

	// remove all children of a node
	function removeAllChild(node) {
		if (node == undefined || node == null)
			return;

		while (node.firstChild)
			node.removeChild(node.firstChild);
	}

	// switch time format
	function switchFormat(offset) {
		var formats = ['24-hour', '12-hour'];
		timeFormat = (timeFormat+ offset)% 2;
		$('time-format').innerHTML = formats[timeFormat];
		update();
	}

	// update table
	function update() {
		displayMonth(0);
	} 

	// return month full name
	function monthFullName(month) {
		var monthName = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
						'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		return monthName[month];
	}

	function $(id) {
		return document.getElementById(id);
	}

</script>
</body>