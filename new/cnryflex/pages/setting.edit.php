<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('setting', 'Settings'),
    array('lib/mapbox'),
    array('lib/mapbox')
);

$main = mysqli_fetch_assoc($core->data->query('SELECT * FROM `tb_settings`')); ?>

<section class='center'>
    <form class='validate cx-form cx-lg' action='<?php echo urlFlex, 'system/process/setting/edit' ?>' method='POST' enctype='multipart/form-data'>
        <?php $core->formTitle('edit', 'Edit Setting') ?>

        <div class='photo'>
            <span class='desc'>
                Main Logo
                <div class='left'>
                    <span aria-label='Format' data-balloon-pos='up'><i class='micon'>image</i>PNG, JPG & JPEG.</span><span aria-label='Minimal Size' data-balloon-pos='up'><i class='micon'>photo_size_select_large</i>300 x 300 Pixel</span>
                </div>
            </span>
            <label for='theImg'><img style='height: 220px; background: #fff; object-fit: scale-down' src='<?php echo urlBase ?>assets/img/<?php echo ($main['img']) ? $main['img'].'?v=2' : '00-no-image.png' ?>' alt='Main Logo'></label><input type='file' accept='image/png, image/jpeg' name='img' id='theImg' class='photo1'/><input class='temporary' id='temporary' disabled>
        </div>

        <div class='obj' style='width: calc(100% - 252px)'>
            <label>Name of Company</label>
            <em class='micon'>business</em>
            <input type='text' name='company' class='with-icon' spellcheck='false' placeholder='Name of company' required value='<?php echo $main['company'] ?>' maxlength='150'/>
        </div>

        <div class='obj switch' style='width: 240px'>
            <label>Maintenance</label>
            <input type='radio' id='switch1' name='maintenance' value='y' <?php echo ($main['maintenance'] == 'y') ? 'checked' : '' ?>><label class='switch-label first' for='switch1'>Yes</label>

            <input type='radio' id='switch2' name='maintenance' value='n' <?php echo ($main['maintenance'] == 'n') ? 'checked' : '' ?>><label class='switch-label' for='switch2'>No</label>
        </div>

        <div class='obj two'>
            <label>Tagline</label>
            <em class='micon'>text_fields</em>
            <input type='text' name='tagline' class='with-icon' spellcheck='false' placeholder='Tagline before the title on the website' required value='<?php echo $main['tagline'] ?>' maxlength='150'/>
        </div>

        <div class='obj two'>
            <label>Trademark</label>
            <i class='micon'>branding_watermark</i>
            <input type='text' name='trademark' class='with-icon' spellcheck='false' placeholder='Company Trademark' required value='<?php echo $main['trademark'] ?>' maxlength='60'/>
        </div>

        <div class='obj'>
            <div class='cx-separate'><label>Description</label> <span class='count check-textarea1 cx-no-margin'></span></div>
            <textarea name='desc' class='check' spellcheck='false' placeholder='Address' check-target='check-textarea1' maxlength='250' required><?php echo $main['desc'] ?></textarea>
        </div>

        <div class='obj two'>
            <label>Email</label>
            <i class='micon'>email</i>
            <input type='email' name='email' class='with-icon' spellcheck='false' placeholder='Email address' required value='<?php echo $main['email'] ?>' maxlength='150'/>
        </div>

        <div class='obj two'>
            <label>Phone Number</label>
            <i class='micon'>phone</i>
            <input type='text' name='phone' class='with-icon' spellcheck='false' placeholder='Ex: 021-29216768 ext 5005' required maxlength='100' value='<?php echo $main['phone'] ?>'/>
        </div>

        <div class='obj'>
            <label>Whatsapp</label>
            <i class='micon'>whatsapp</i>
            <input type='text' name='whatsapp' class='with-icon' spellcheck='false' placeholder='Whatsapp Link' required value='<?php echo $main['whatsapp'] ?>' maxlength='150'/>
        </div>

        <div class='obj three'>
            <label>Youtube URL</label>
            <input type='text' name='youtube' spellcheck='false' maxlength='150' placeholder='Youtube URL' value='<?php echo $main['youtube'] ?>'/>
        </div>

        <div class='obj three'>
            <label>Facebook URL</label>
            <input type='text' name='facebook' spellcheck='false' maxlength='150' placeholder='Facebook URL' value='<?php echo $main['facebook'] ?>'/>
        </div>

        <div class='obj three'>
            <label>Instagram URL</label>
            <input type='text' name='instagram' spellcheck='false' maxlength='150' placeholder='Instagram URL' value='<?php echo $main['instagram'] ?>'/>
        </div>

        <div class='obj two'>
            <label>Latitude</label>
            <i class='micon icon'>gps_fixed</i>
            <input type='text' name='latitude' class='with-icon' spellcheck='false' placeholder='Latitude' autocomplete='off' required value='<?php echo $main['latitude'] ?>' maxlength='50' />
        </div>
        
        <div class='obj two'>
            <label>Longitude</label>
            <i class='micon icon'>gps_fixed</i>
            <input type='text' name='longitude' class='with-icon' spellcheck='false' placeholder='Longitude' autocomplete='off' required value='<?php echo $main['longitude'] ?>' maxlength='50'/>
        </div>

        <div id='maps'></div>

        <div class='obj'>
            <label>Google Maps</label>
            <i class='micon'>map</i>
            <input type='text' name='googleMaps' class='with-icon' spellcheck='false' placeholder='Link to Google Maps' value='<?php echo $main['googleMaps'] ?>' maxlength='250'/>
        </div>

        <div class='obj'>
            <div class='cx-separate'><label>Address</label> <span class='count check-textarea cx-no-margin'></span></div>
            <textarea name='address' class='check' spellcheck='false' placeholder='Address' check-target='check-textarea' maxlength='250' required><?php echo $main['address'] ?></textarea>
        </div>

        <div class='obj two'>
            <label>Office Hour (Open)</label>
            <i class='micon'>meeting_room</i>
            <input type='text' name='officeOpen' class='with-icon' spellcheck='placeholder' maxlength='150' placeholder='early week office open' required value='<?php echo $main['officeOpen'] ?>'/>
        </div>

        <div class='obj two'>
            <label>Office Hour (Close)</label>
            <i class='micon'>door_front</i>
            <input type='text' name='officeClose' class='with-icon' spellcheck='placeholder' maxlength='150' placeholder='Last day the office is closed on the weekend' required value='<?php echo $main['officeClose'] ?>'/>
        </div>

        <?php $core->modified($main['created'], $main['modified'], 'Edit%20Setting') ?>

        <button type='submit' class='with-cancel'>Submit</button>
        <a class='cancel' onclick='history.back()'>Cancel</a>
    </form>

    <script>
        function openMaps(latitude, longitude){
            mapboxgl.accessToken = 'pk.eyJ1IjoiYmluc2FyaGFyc2VubyIsImEiOiI0NC1uUF9FIn0.gryT1dBi1_mxnyrUQLwNLA';
            var map = new mapboxgl.Map({
                container: 'maps',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [latitude, longitude],
                zoom: 13
            });

            var popup = new mapboxgl.Popup().setHTML('<h3>Location</h3>');
            new mapboxgl.Marker().setLngLat([latitude, longitude]).setPopup(popup).addTo(map);
        }

        var iLatitude = $("input[name='latitude']").val();
        var iLongitude = $("input[name='longitude']").val();
        openMaps(iLatitude, iLongitude);

        $("input[name='latitude']").keyup(function(){
            var iLatitude = $("input[name='latitude']").val();
            var iLongitude = $("input[name='longitude']").val();
            openMaps(iLatitude, iLongitude);
        });

        $("input[name='longitude']").keyup(function(){
            var iLatitude = $("input[name='latitude']").val();
            var iLongitude = $("input[name='longitude']").val();
            openMaps(iLatitude, iLongitude);
        });

        var brand = document.getElementById('theImg');
        brand.className = 'photo1';
        brand.onchange = function() {
            document.getElementById('temporary').value = this.value.substring(12);
        };

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("label[for='theImg'] img").attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#theImg').change(function() {
            readURL(this);
        });

        $(document).ready(function(){
            $('.check').trigger('keyup');
        });
    </script>

<?php $core->close();