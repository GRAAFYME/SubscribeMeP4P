<div class="content">
    <h1><?php echo $title; ?></h1>
    <p><?php echo $message; ?></p>
    <?php echo validation_errors(); ?>
    <form method="post" action="<?php echo $action; ?>">
    <div class="data">
    <table>
<!--             <tr>
            <td width="30%">ID</td>
            <td><input type="text" name="id" disabled="disable" class="text" value="<?php echo $this->form_validation->id; ?>"/></td>
            <input type="hidden" name="id" value="<?php echo $this->form_validation->id; ?>"/>
        </tr> -->
        <tr>
            <td valign="top"><?php echo $course_name_fieldname; ?><span style="color:red;">*</span></td>
            <td><input type="text" name="<?php echo $course_name_fieldname; ?>" class="text" value="<?php echo $this->form_validation->$course_name_fieldname; ?>"/>
            </td>
        </tr>
        <tr>
            <td valign="top"><?php echo $year_fieldname; ?><span style="color:red;">*</span></td>
            <td><textarea id="<?php echo $year_fieldname; ?>" name="<?php echo $year_fieldname; ?>" wrap = "hard" rows ="10" cols="70" value="<?php echo $this->form_validation->$year_fieldname; ?>" ><?php echo $this->form_validation->$year_fieldname; ?></textarea>
            </td>
        </tr>
         <tr>
            <td valign="top"><?php echo $period_fieldname; ?><span style="color:red;">*</span></td>
            <td><textarea id="<?php echo $period_fieldname; ?>" name="<?php echo $period_fieldname; ?>" wrap = "hard" rows ="10" cols="70" value="<?php echo $this->form_validation->$period_fieldname; ?>" ><?php echo $this->form_validation->period_fieldname; ?></textarea>
            </td>
        </tr>
        <tr>
            <td valign="top"><?php echo $test_fieldname; ?><span style="color:red;">*</span></td>
            <td><textarea id="<?php echo $test_fieldname; ?>" name="<?php echo $test_fieldname; ?>" wrap = "hard" rows ="10" cols="70" value="<?php echo $this->form_validation->$test_fieldname; ?>" ><?php echo $this->form_validation->$test_fieldname; ?></textarea>
            </td>
        </tr>
        <!-- <tr>
            <td valign="top">Date (dd-mm-yyyy)<span style="color:red;">*</span></td>
            <td><input type="text" name="date" onclick="displayDatePicker('date');" class="text" value="<?php echo $this->validation->date; ?>"/>
            <a href="javascript:void(0);" onclick="displayDatePicker('date');"><img src="<?php echo base_url(); ?>style/images/calendar.png" alt="calendar" border="0"></a>
            </td>
        </tr> -->
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Save"/></td>
        </tr>
    </table>
    </div>
    </form>
    <br />
    <?php echo $link_back; ?>
</div>