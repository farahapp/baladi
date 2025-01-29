$(document).ready(function(){

$(document).on('click','.are_you_shur',function(e){
 var res=confirm("Are you sure?");
 if(!res){
   return false; 
 }

});


// ============================================================================================================
$(document).on('click','#change_driver_photo',function(e){
  e.preventDefault();
         $("#driver_photo_oldImage").after('<input type="file" name=driver_photo id=driver_photo > ');
         $("#change_driver_photo").hide();
         $("#cancel_driver_photo").show();
         return false;
});

$(document).on('click','#cancel_driver_photo',function(e){
  e.preventDefault();
         $("#driver_photo").hide();
         $("#cancel_driver_photo").hide();
         $("#change_driver_photo").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_sudanese_driving_license_Image',function(e){
  e.preventDefault();
         $("#sudanese_driving_license_Image_oldImage").after('<input type="file" name=sudanese_driving_license_Image id=sudanese_driving_license_Image > ');
         $("#change_sudanese_driving_license_Image").hide();
         $("#cancel_sudanese_driving_license_Image").show();
         return false;
});

$(document).on('click','#cancel_sudanese_driving_license_Image',function(e){
  e.preventDefault();
         $("#sudanese_driving_license_Image").hide();
         $("#cancel_sudanese_driving_license_Image").hide();
         $("#change_sudanese_driving_license_Image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_initial_contract_image',function(e){
  e.preventDefault();
         $("#initial_contract_image_oldImage").after('<input type="file" name=initial_contract_image id=initial_contract_image > ');
         $("#change_initial_contract_image").hide();
         $("#cancel_initial_contract_image").show();
         return false;
});

$(document).on('click','#cancel_initial_contract_image',function(e){
  e.preventDefault();
         $("#initial_contract_image").hide();
         $("#cancel_initial_contract_image").hide();
         $("#change_initial_contract_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_isSigningMainContractImage',function(e){
  e.preventDefault();
         $("#isSigningMainContractImage_oldImage").after('<input type="file" name=isSigningMainContractImage id=isSigningMainContractImage > ');
         $("#change_isSigningMainContractImage").hide();
         $("#cancel_isSigningMainContractImage").show();
         return false;
});

$(document).on('click','#cancel_isSigningMainContractImage',function(e){
  e.preventDefault();
         $("#isSigningMainContractImage").hide();
         $("#cancel_isSigningMainContractImage").hide();
         $("#change_isSigningMainContractImage").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_give_passport_image',function(e){
  e.preventDefault();
         $("#give_passport_image_oldImage").after('<input type="file" name=give_passport_image id=give_passport_image > ');
         $("#change_give_passport_image").hide();
         $("#cancel_give_passport_image").show();
         return false;
});

$(document).on('click','#cancel_give_passport_image',function(e){
  e.preventDefault();
         $("#give_passport_image").hide();
         $("#cancel_give_passport_image").hide();
         $("#change_give_passport_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_SigningFullFinancialDebt_Image',function(e){
  e.preventDefault();
         $("#SigningFullFinancialDebt_Image_oldImage").after('<input type="file" name=SigningFullFinancialDebt_Image id=SigningFullFinancialDebt_Image > ');
         $("#change_SigningFullFinancialDebt_Image").hide();
         $("#cancel_SigningFullFinancialDebt_Image").show();
         return false;
});

$(document).on('click','#cancel_SigningFullFinancialDebt_Image',function(e){
  e.preventDefault();
         $("#SigningFullFinancialDebt_Image").hide();
         $("#cancel_SigningFullFinancialDebt_Image").hide();
         $("#change_SigningFullFinancialDebt_Image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_isSigningPenaltyClause_Image',function(e){
  e.preventDefault();
         $("#isSigningPenaltyClause_Image_oldImage").after('<input type="file" name=isSigningPenaltyClause_Image id=isSigningPenaltyClause_Image > ');
         $("#change_isSigningPenaltyClause_Image").hide();
         $("#cancel_isSigningPenaltyClause_Image").show();
         return false;
});

$(document).on('click','#cancel_isSigningPenaltyClause_Image',function(e){
  e.preventDefault();
         $("#isSigningPenaltyClause_Image").hide();
         $("#cancel_isSigningPenaltyClause_Image").hide();
         $("#change_isSigningPenaltyClause_Image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_SigningFullFinancialDebtCheck_Image',function(e){
  e.preventDefault();
         $("#SigningFullFinancialDebtCheck_Image_oldImage").after('<input type="file" name=SigningFullFinancialDebtCheck_Image id=SigningFullFinancialDebtCheck_Image > ');
         $("#change_SigningFullFinancialDebtCheck_Image").hide();
         $("#cancel_SigningFullFinancialDebtCheck_Image").show();
         return false;
});

$(document).on('click','#cancel_SigningFullFinancialDebtCheck_Image',function(e){
  e.preventDefault();
         $("#SigningFullFinancialDebtCheck_Image").hide();
         $("#cancel_SigningFullFinancialDebtCheck_Image").hide();
         $("#change_SigningFullFinancialDebtCheck_Image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_isSigningPenaltyClauseCheck_Image',function(e){
  e.preventDefault();
         $("#isSigningPenaltyClauseCheck_Image_oldImage").after('<input type="file" name=isSigningPenaltyClauseCheck_Image id=isSigningPenaltyClauseCheck_Image > ');
         $("#change_isSigningPenaltyClauseCheck_Image").hide();
         $("#cancel_isSigningPenaltyClauseCheck_Image").show();
         return false;
});

$(document).on('click','#cancel_isSigningPenaltyClauseCheck_Image',function(e){
  e.preventDefault();
         $("#isSigningPenaltyClauseCheck_Image").hide();
         $("#cancel_isSigningPenaltyClauseCheck_Image").hide();
         $("#change_isSigningPenaltyClauseCheck_Image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_flat_image',function(e){
  e.preventDefault();
         $("#flat_image_oldImage").after('<input type="file" name=flat_image id=flat_image > ');
         $("#change_flat_image").hide();
         $("#cancel_flat_image").show();
         return false;
});

$(document).on('click','#cancel_flat_image',function(e){
  e.preventDefault();
         $("#flat_image").hide();
         $("#cancel_flat_image").hide();
         $("#change_flat_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_qatary_driving_license_Image_image',function(e){
  e.preventDefault();
         $("#qatary_driving_license_Image_image_oldImage").after('<input type="file" name=qatary_driving_license_Image_image id=qatary_driving_license_Image_image > ');
         $("#change_qatary_driving_license_Image_image").hide();
         $("#cancel_qatary_driving_license_Image_image").show();
         return false;
});

$(document).on('click','#cancel_qatary_driving_license_Image_image',function(e){
  e.preventDefault();
         $("#qatary_driving_license_Image_image").hide();
         $("#cancel_qatary_driving_license_Image_image").hide();
         $("#change_qatary_driving_license_Image_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_driver_pasport_image',function(e){
  e.preventDefault();
         $("#driver_pasport_image_oldImage").after('<input type="file" name=driver_pasport_image id=driver_pasport_image > ');
         $("#change_driver_pasport_image").hide();
         $("#cancel_driver_pasport_image").show();
         return false;
});

$(document).on('click','#cancel_driver_pasport_image',function(e){
  e.preventDefault();
         $("#driver_pasport_image").hide();
         $("#cancel_driver_pasport_image").hide();
         $("#change_driver_pasport_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_visa_image',function(e){
  e.preventDefault();
         $("#visa_image_oldImage").after('<input type="file" name=visa_image id=visa_image > ');
         $("#change_visa_image").hide();
         $("#cancel_visa_image").show();
         return false;
});

$(document).on('click','#cancel_visa_image',function(e){
  e.preventDefault();
         $("#visa_image").hide();
         $("#cancel_visa_image").hide();
         $("#change_visa_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_post_pay_pill_image2',function(e){
  e.preventDefault();
         $("#post_pay_pill_image_oldImage").after('<input type="file" name=post_pay_pill_image id=post_pay_pill_image > ');
         $("#change_post_pay_pill_image2").hide();
         $("#cancel_post_pay_pill_image").show();
         return false;
});

$(document).on('click','#cancel_post_pay_pill_image',function(e){
  e.preventDefault();
         $("#post_pay_pill_image").hide();
         $("#cancel_post_pay_pill_image").hide();
         $("#change_post_pay_pill_image2").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_driver_residency_id_Image',function(e){
  e.preventDefault();
         $("#driver_residency_id_Image_oldImage").after('<input type="file" name=driver_residency_id_Image id=driver_residency_id_Image > ');
         $("#change_driver_residency_id_Image").hide();
         $("#cancel_driver_residency_id_Image").show();
         return false;
});

$(document).on('click','#cancel_driver_residency_id_Image',function(e){
  e.preventDefault();
         $("#driver_residency_id_Image").hide();
         $("#cancel_driver_residency_id_Image").hide();
         $("#change_driver_residency_id_Image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_loan_image',function(e){
  e.preventDefault();
         $("#loan_image_oldImage").after('<input type="file" name=loan_image id=loan_image > ');
         $("#change_loan_image").hide();
         $("#cancel_loan_image").show();
         return false;
});

$(document).on('click','#cancel_loan_image',function(e){
  e.preventDefault();
         $("#loan_image").hide();
         $("#cancel_loan_image").hide();
         $("#change_loan_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_no_objection_image',function(e){
  e.preventDefault();
  alert('');
        //  $("#no_objection_image_oldImage").after('<input type="file" name=no_objection_image id=no_objection_image > ');
        //  $("#change_no_objection_image").hide();
        //  $("#cancel_no_objection_image").show();
         return false;
});

$(document).on('click','#cancel_no_objection_image',function(e){
  e.preventDefault();
         $("#no_objection_image").hide();
         $("#cancel_no_objection_image").hide();
         $("#change_no_objection_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_old_qid_image',function(e){
  e.preventDefault();
         $("#old_qid_image_oldImage").after('<input type="file" name=old_qid_image id=old_qid_image > ');
         $("#change_old_qid_image").hide();
         $("#cancel_old_qid_image").show();
         return false;
});

$(document).on('click','#cancel_old_qid_image',function(e){
  e.preventDefault();
         $("#old_qid_image").hide();
         $("#cancel_old_qid_image").hide();
         $("#change_old_qid_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_vechile_registeration_image',function(e){
  e.preventDefault();
         $("#vechile_registeration_image_oldImage").after('<input type="file" name=vechile_registeration_image id=vechile_registeration_image > ');
         $("#change_vechile_registeration_image").hide();
         $("#cancel_vechile_registeration_image").show();
         return false;
});

$(document).on('click','#cancel_vechile_registeration_image',function(e){
  e.preventDefault();
         $("#vechile_registeration_image").hide();
         $("#cancel_vechile_registeration_image").hide();
         $("#change_vechile_registeration_image").show();
         return false;
});
// ============================================================================================================
$(document).on('click','#change_vechile_image',function(e){
  e.preventDefault();
         $("#vechile_image_oldImage").after('<input type="file" name=vechile_image id=vechile_image > ');
         $("#change_vechile_image").hide();
         $("#cancel_vechile_image").show();
         return false;
});

$(document).on('click','#cancel_vechile_image',function(e){
  e.preventDefault();
         $("#vechile_image").hide();
         $("#cancel_vechile_image").hide();
         $("#change_vechile_image").show();
         return false;
});
// ============================================================================================================






});