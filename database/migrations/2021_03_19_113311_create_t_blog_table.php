<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_blog', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('BlogId');            
            $table->string('BlogType',20);/*Text/Video/Racipies/News*/
            $table->datetime('BlogDateTime');
            $table->string('BlogTitle',50);
            $table->text('Thumbnail');
            $table->text('EmbedCode')->nullable();
            $table->text('Content');
            $table->timestamps();
        });

         /*Default value insert*/
        DB::table('t_blog')->insert([
            ['BlogId' => '1','BlogType' => 'Text','BlogDateTime' => '2022-01-01 10:15:10','BlogTitle' => 'When to take your medicine',"Thumbnail"=>"blog/blog1.jpeg","EmbedCode"=>"","Content"=>"Many people who are taking tablets or other medicines, either on prescription or over-the-counter, are not sure about the best time to take them, especially in relation to meal times. There is no simple answer to this question. However, as a general rule you should take medicine on an empty stomach. This is because many medicines can be affected by what you eat and when you eat it. For example, taking a pill at the same time you eat may interfere with the way your stomach and intestines absorb the medicine. If you have food in your stomach at the same time as you take a medicine, it may delay or decrease the absorption of the drug. There are many exceptions to this rule. Some medicines, such as aspirin and other anti-inflammatory drugs, are easier to tolerate with food. It may be preferable to take them with or immediately after a meal to reduce the risk of side effects such as acid reflux and gastric bleeding. It is sensible to ask your doctor or pharmacist whether it’s okay or preferable to take your medicine with a snack or a meal. As well as affecting your body’s ability to absorb medicines, some foods can react with the ingredients of a medicine you are taking, stopping the medicine from working the way it should. Such drug-food interactions can happen with both prescription and over-the-counter medicines, including antacids, vitamins and iron pills. Equally important, and sometimes dangerous, is the chance of a new medicine reacting with one you are already taking."],

            ['BlogId' => '2','BlogType' => 'Video','BlogDateTime' => '2022-01-10 21:30:32','BlogTitle' => 'Coronavirus test online registration',"Thumbnail"=>"","EmbedCode"=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/PHW6SD2h8vU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',"Content"=>"We can registraion for COVID 19 test by online."],


            ['BlogId' => '3','BlogType' => 'Text','BlogDateTime' => '2022-01-24 18:25:11','BlogTitle' => 'Blood pressure test',"Thumbnail"=>"blog/blog2.jpeg","EmbedCode"=>"","Content"=>"A blood pressure test measures the pressure in your arteries as your heart pumps. You might have a blood pressure test as a part of a routine doctor's appointment or as a screening for high blood pressure (hypertension). Some people use a blood pressure test at home to better track their heart health."],

            ['BlogId' => '4','BlogType' => 'Text','BlogDateTime' => '2022-01-031 15:14:33','BlogTitle' => 'Physical activity guidelines for adults',"Thumbnail"=>"blog/blog3.jpeg","EmbedCode"=>"","Content"=>"Adults should do some type of physical activity every day. Exercise just once or twice a week can reduce the risk of heart disease or stroke. Speak to your GP first if you have not exercised for some time, or if you have medical conditions or concerns. Make sure your activity and its intensity are appropriate for your fitness."],

          ['BlogId' => '5','BlogType' => 'Video','BlogDateTime' => '2022-02-05 21:30:32','BlogTitle' => 'Gas problem solution',"Thumbnail"=>"","EmbedCode"=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/B-5wCEpCYxk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',"Content"=>"Is you gassy? Here's what causes infant gas and the best treatments for baby gas relief."]
        ]);
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_blog');
    }
}
