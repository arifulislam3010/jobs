<template>
	<div>
		<div v-if="showHeader" class="page-header-div mb-4">
			<div class="container">
				<nuxt-link to="/"><span><i class="fa fa-home mr-3"></i></span></nuxt-link><span><i class="fa fa-arrow-right mr-3"></i></span><span style="font-size:16px;font-weight:bold" class="header">{{ header }}</span>
			</div>
		</div>
	</div>
</template>
<script>
  export default {
    data() {
      return {
        header: '',
        showHeader: 0
      }
    },
    mounted(){
	    if(this.$route.name=='notice-of-appointment'){
    		this.header = 'নিয়োগ বিজ্ঞপ্তি';
        	this.showHeader = 1;
    	}else if(this.$route.name=='complaint'){
    		this.header = 'অভিযোগ';
    		this.showHeader = 1;
    	}else if(this.$route.name=='forms-downloads'){
    		this.header = 'ফরম ডাউনলোড';
    		this.showHeader = 1;
    	}else if(this.$route.name=='notices'){
    		this.header = 'নোটিশ বোর্ড';
    		this.showHeader = 1;
		}else if(this.$route.params.title =='recruiting-agency'){
    		this.header = 'সরকার অনুমোদিত এজেন্সি';
    		this.showHeader = 1;
    	}else if(this.$route.params.others =='অভিবাসন-প্রক্রিয়া'){
    		this.header = 'অভিবাসন প্রক্রিয়া';
    		this.showHeader = 1;
    	}else if(this.$route.params.others =='প্রবাসে-করণীয়'){
    		this.header = 'প্রবাসে করণীয়';
    		this.showHeader = 1;
    	}else if(this.$route.params.others =='বিদেশ-যাত্রার-প্রস্তুতি'){
    		this.header = 'বিদেশ যাত্রার প্রস্তুতি';
    		this.showHeader = 1;
		}
		else if(this.$route.params.others =='বৈধ-ভাবে-টাকা-পাঠানো'){
    		this.header = 'বৈধ ভাবে টাকা পাঠানো';
    		this.showHeader = 1;
		}
		else if(this.$route.params.others =='গুরুত্বপূর্ণ-এমব্যাসি'){
    		this.header = 'গুরুত্বপূর্ণ এমব্যাসি';
    		this.showHeader = 1;
		}
		else if(this.$route.params.others =='সচরাচর-জিজ্ঞাসা'){
    		this.header = 'সচরাচর জিজ্ঞাসা';
    		this.showHeader = 1;
		}
		else if(this.$route.params.others =='অভিযোগ-প্রতিকার-সংক্রান্ত-তথ্য'){
    		this.header = 'অভিযোগ প্রতিকার সংক্রান্ত তথ্য';
    		this.showHeader = 1;
		}
		else if(this.$route.params.others =='মতামত'){
    		this.header = 'মতামত';
    		this.showHeader = 1;
		}
		else if(this.$route.params.others =='সিটিজেন-চার্টার'){
    		this.header = 'সিটিজেন চার্টার';
    		this.showHeader = 1;
		}
		else if(this.$route.params.title =='stories'){
			this.header = 'সাফল্যের গল্প';
			this.showHeader = 1;
		}
		else if(this.$route.params.type =='story'){
			this.header = 'সাফল্যের গল্প';
			this.showHeader = 1;
		}
		else if(this.$route.params.title =='notices'){
			this.header = 'নোটিশ';
			this.showHeader = 1;
		}
		else if(this.$route.params.title =='questions'){
			this.header = 'সচরাচর জিজ্ঞাসা';
			this.showHeader = 1;
		}
		else if(this.$route.params.type =='question'){
			this.header = 'সচরাচর জিজ্ঞাসা';
			this.showHeader = 1;
		}
		else{
    		this.showHeader = 0;
    	}
	},
	watch: {
	    $route(to, from) {
	    	if(to.name=='notice-of-appointment'){
	    		this.header = 'নিয়োগ বিজ্ঞপ্তি';
	        	this.showHeader = 1;
	    	}else if(to.name=='complaint'){
	    		this.header = 'অভিযোগ';
	    		this.showHeader = 1;
	    	}else if(to.name=='forms-downloads'){
	    		this.header = 'ফরম ডাউনলোড';
	    		this.showHeader = 1;
	    	}else if(to.name=='notices'){
	    		this.header = 'নোটিশ বোর্ড';
	    		this.showHeader = 1;
	    	}else if(to.params.title=='recruiting-agency'){
	    		this.header = 'সরকার অনুমোদিত এজেন্সি';
	    		this.showHeader = 1;
	    	}else if(to.params.others =='অভিবাসন-প্রক্রিয়া'){
	    		this.header = 'অভিবাসন প্রক্রিয়া';
	    		this.showHeader = 1;
			}else if(to.params.others =='প্রবাসে-করণীয়'){
				this.header = 'প্রবাসে করণীয়';
				this.showHeader = 1;
			}else if(to.params.others =='বিদেশ-যাত্রার-প্রস্তুতি'){
				this.header = 'বিদেশ যাত্রার প্রস্তুতি';
				this.showHeader = 1;
			}else if(to.params.others =='বৈধ-ভাবে-টাকা-পাঠানো'){
				this.header = 'বৈধ ভাবে টাকা পাঠানো';
				this.showHeader = 1;
			}else if(to.params.others =='গুরুত্বপূর্ণ-এমব্যাসি'){
				this.header = 'গুরুত্বপূর্ণ এমব্যাসি';
				this.showHeader = 1;
			}
			else if(to.params.others =='সচরাচর-জিজ্ঞাসা'){
				this.header = 'সচরাচর জিজ্ঞাসা';
				this.showHeader = 1;
			}
			else if(to.params.others =='অভিযোগ-প্রতিকার-সংক্রান্ত-তথ্য'){
				this.header = 'অভিযোগ প্রতিকার সংক্রান্ত তথ্য';
				this.showHeader = 1;
			}
			else if(to.params.others =='মতামত'){
				this.header = 'মতামত';
				this.showHeader = 1;
			}
			else if(to.params.others =='সিটিজেন-চার্টার'){
				this.header = 'সিটিজেন চার্টার';
				this.showHeader = 1;
			}
			else if(to.params.title =='stories'){
				this.header = 'সাফল্যের গল্প';
				this.showHeader = 1;
			}
			else if(to.params.type =='story'){
				this.header = 'সাফল্যের গল্প';
				this.showHeader = 1;
			}
			else if(to.params.title =='notices'){
				this.header = 'নোটিশ';
				this.showHeader = 1;
			}
			else if(to.params.type =='notice'){
				this.header = 'নোটিশ';
				this.showHeader = 1;
			}
			else if(to.params.title =='questions'){
				this.header = 'সচরাচর জিজ্ঞাসা';
				this.showHeader = 1;
			}
			else if(to.params.type =='question'){
				this.header = 'সচরাচর জিজ্ঞাসা';
				this.showHeader = 1;
			}
			else{
	    		this.showHeader = 0;
	    	}
	    }
	},
  }
</script>
<style scoped>
	.page-header-div { background-color: #edf7ef; text-align: left; padding: 10px; color: #474946; }
	.header { font-size: 12px; }
	.fa { font-weight: 500; color: #474946; }
</style>