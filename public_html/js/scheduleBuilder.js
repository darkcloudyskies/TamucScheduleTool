var mondayTimeblockCounter = 0;

$("#mondayAddTimeBtn").on("click",function(){

    var timeblock = $("#mondayTimeBlock0").clone();
    timeblock.prop("id","mondayTimeBlock" + (++mondayTimeblockCounter));
    timeblock.find("#mondayStartTime0").attr("name","mondayStartTime[" + mondayTimeblockCounter + "]");
    timeblock.find("#mondayEndTime0").attr("name","mondayEndTime[" + mondayTimeblockCounter + "]");
    timeblock.find("#mondayStartTime0").prop("id","mondayStartTime" + mondayTimeblockCounter);
    timeblock.find("#mondayEndTime0").prop("id","mondayEndTime" + mondayTimeblockCounter);

    $("#mondayTimeBlock" + (mondayTimeblockCounter-1)).after(timeblock);
});

$("#mondayRemoveTimeBtn").on("click",function(){

    $("#mondayTimeBlock" + (mondayTimeblockCounter--)).remove();
});

var tuesdayTimeblockCounter = 0;

$("#tuesdayAddTimeBtn").on("click",function(){

    var timeblock = $("#tuesdayTimeBlock0").clone();
    timeblock.prop("id","tuesdayTimeBlock" + (++tuesdayTimeblockCounter));
    timeblock.find("#tuesdayStartTime0").attr("name","tuesdayStartTime[" + tuesdayTimeblockCounter + "]");
    timeblock.find("#tuesdayEndTime0").attr("name","tuesdayEndTime[" + tuesdayTimeblockCounter + "]");
    timeblock.find("#tuesdayStartTime0").prop("id","tuesdayStartTime" + tuesdayTimeblockCounter);
    timeblock.find("#tuesdayEndTime0").prop("id","tuesdayEndTime" + tuesdayTimeblockCounter);

    $("#tuesdayTimeBlock" + (tuesdayTimeblockCounter-1)).after(timeblock);
});

$("#tuesdayRemoveTimeBtn").on("click",function(){

    $("#tuesdayTimeBlock" + (tuesdayTimeblockCounter--)).remove();
});

var wednesdayTimeblockCounter = 0;

$("#wednesdayAddTimeBtn").on("click",function(){

    var timeblock = $("#wednesdayTimeBlock0").clone();
    timeblock.prop("id","wednesdayTimeBlock" + (++wednesdayTimeblockCounter));
    timeblock.find("#wednesdayStartTime0").attr("name","wednesdayStartTime[" + wednesdayTimeblockCounter + "]");
    timeblock.find("#wednesdayEndTime0").attr("name","wednesdayEndTime[" + wednesdayTimeblockCounter + "]");
    timeblock.find("#wednesdayStartTime0").prop("id","wednesdayStartTime" + wednesdayTimeblockCounter);
    timeblock.find("#wednesdayEndTime0").prop("id","wednesdayEndTime" + wednesdayTimeblockCounter);

    $("#wednesdayTimeBlock" + (wednesdayTimeblockCounter-1)).after(timeblock);
});

$("#wednesdayRemoveTimeBtn").on("click",function(){

    $("#wednesdayTimeBlock" + (wednesdayTimeblockCounter--)).remove();
});

var thursdayTimeblockCounter = 0;

$("#thursdayAddTimeBtn").on("click",function(){

    var timeblock = $("#thursdayTimeBlock0").clone();
    timeblock.prop("id","thursdayTimeBlock" + (++thursdayTimeblockCounter));
    timeblock.find("#thursdayStartTime0").attr("name","thursdayStartTime[" + thursdayTimeblockCounter + "]");
    timeblock.find("#thursdayEndTime0").attr("name","thursdayEndTime[" + thursdayTimeblockCounter + "]");
    timeblock.find("#thursdayStartTime0").prop("id","thursdayStartTime" + thursdayTimeblockCounter);
    timeblock.find("#thursdayEndTime0").prop("id","thursdayEndTime" + thursdayTimeblockCounter);

    $("#thursdayTimeBlock" + (thursdayTimeblockCounter-1)).after(timeblock);
});

$("#thursdayRemoveTimeBtn").on("click",function(){

    $("#thursdayTimeBlock" + (thursdayTimeblockCounter--)).remove();
});

var fridayTimeblockCounter = 0;

$("#fridayAddTimeBtn").on("click",function(){

    var timeblock = $("#fridayTimeBlock0").clone();
    timeblock.prop("id","fridayTimeBlock" + (++fridayTimeblockCounter));
    timeblock.find("#fridayStartTime0").attr("name","fridayStartTime[" + fridayTimeblockCounter + "]");
    timeblock.find("#fridayEndTime0").attr("name","fridayEndTime[" + fridayTimeblockCounter + "]");
    timeblock.find("#fridayStartTime0").prop("id","fridayStartTime" + fridayTimeblockCounter);
    timeblock.find("#fridayEndTime0").prop("id","fridayEndTime" + fridayTimeblockCounter);

    $("#fridayTimeBlock" + (fridayTimeblockCounter-1)).after(timeblock);
});

$("#fridayRemoveTimeBtn").on("click",function(){

    $("#fridayTimeBlock" + (fridayTimeblockCounter--)).remove();
});